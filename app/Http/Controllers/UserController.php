<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        // $this->middleware(['permission:user-list|user-create|user-edit|user-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:user-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:user-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:user-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function show($id)
    {
        $user = User::find($id);
        if($user)
            return response()->json(['status' => 'success', 'data' => ['user' => json_encode($user)]]);
        else
            return response()->json(['status' => 'error', 'data' => []]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
        ]);
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' =>  $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => Hash::make($request->input('password'))
            ]);
            $role = Role::where('id', $request->input('role'))->first();
            $permissions = Permission::pluck('id', 'id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
            DB::commit();
            return response()->json(['success' => 'User created successfully']);
        } catch (\Exception $e) {
            DB::rollback(); 
            return response()->json(['error' => 'Oops Something went wrong. Please try again later']);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $user = User::where('id', $id)->update([
                'name' => $request->input('name'),
                'email' =>  $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => Hash::make($request->input('password'))
            ]);
            $user = User::findOrFail($id);
            $role = Role::where('id', $request->input('role'))->first();
            $permissions = Permission::pluck('id', 'id')->all();
            $role->syncPermissions($permissions);
            $user->syncRoles([$role->id]);
            DB::commit();
            return response()->json(['success' => 'User updated successfully']);
        } catch (\Exception $e) {
            DB::rollback(); 
            return response()->json(['error' => 'Oops Something went wrong. Please try again later']);
        }
    }

    public function destroy($id)
    {
        DB::table("users")->where('id', $id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
