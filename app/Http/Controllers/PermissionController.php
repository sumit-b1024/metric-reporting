<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    function __construct()
    {
        // $this->middleware(['permission:permission-list|permission-create|permission-edit|permission-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:permission-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:permission-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:permission-delete'], ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $permission_groups = PermissionGroup::with('permissions')->paginate(10);
        return view('permissions.index', compact('permission_groups'));
    }

    public function show($id)
    {
        $permission_group = PermissionGroup::with('permissions')->where('id', $id)->first();
        if($permission_group)
            return response()->json(['status' => 'success', 'data' => json_encode($permission_group)]);
        else
            return response()->json(['status' => 'error', 'data' => []]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'prefix' => 'required',
            'operation' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $permission_group = PermissionGroup::create(['name' => $request->name]);
            foreach($request->operation as $operation)
            {
                Permission::create(['name' => $request->prefix.'-'.$operation, 'group_id' => $permission_group->id]);
            }       
            DB::commit();
            return response()->json(['success' => 'Permission created successfully']);
        } catch (\Exception $e) {
            DB::rollback(); 
            return response()->json(['error' => 'Oops Something went wrong. Please try again later']);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'prefix' => 'required',
            'operation' => 'required',
            'id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $permissionGroup = PermissionGroup::where('id', $request->id)->first();

            if (!$permissionGroup) {
                return response()->json(['error' => 'Oops Something went wrong. Please try again later']);
            }

            PermissionGroup::where('id', $request->id)->update(['name' => $request->name]);
            Permission::where('group_id', $request->id)->delete();
            foreach ($request->operation as $operation) {
                $permissionName = $request->prefix . '-' . $operation;
                Permission::create(['name' => $permissionName, 'group_id' => $permissionGroup->id]);
            }

            DB::commit();
            return response()->json(['success' => 'Permissions updated successfully']);
        } catch (\Exception $e) {
            DB::rollback(); 
            return response()->json(['error' => 'Oops Something went wrong. Please try again later']);
        }
    }

    public function destroy($id) {
        PermissionGroup::where('id', $id)->delete();
        Permission::where('group_id', $id)->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
