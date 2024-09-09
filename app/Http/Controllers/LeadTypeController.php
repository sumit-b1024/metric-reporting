<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeadType;
use Illuminate\Support\Facades\DB;
use Auth;

class LeadTypeController extends Controller
{
    function __construct()
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $lead_types = LeadType::orderBy('id', 'ASC')->paginate(10);
        return view('lead_type.index', compact('lead_types'));
    }

    public function create()
    {
        $lead_type = LeadType::get();
        return view('lead_type.create', compact('lead_type'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:lead_types,name',
        ]);
        DB::beginTransaction();
        try {
            $lead_type = LeadType::create(['name' => $request->input('name'), 'status' => $request->input('status'), 'created_by' => Auth::user()->id]);
            DB::commit();
            return response()->json(['success' => 'Lead Type created successfully']);
        } catch (\Exception $e) {
            DB::rollback(); 
            return response()->json(['error' => 'Oops Something went wrong. Please try again later']);
        }
    }

    public function show($id)
    {
        $lead_type = LeadType::find($id);
        
        if($lead_type)
            return response()->json(['status' => 'success', 'data' => ['lead_type' => json_encode($lead_type)]]);
        else
            return response()->json(['status' => 'error', 'data' => []]);
    }

    public function edit($id)
    {
        $lead_type = LeadType::find($id);
        return view('lead_type.edit', compact('lead_type'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $lead_type = LeadType::find($id);
            $lead_type->name = $request->input('name');
            $lead_type->status = $request->input('status');
            $lead_type->save();
            DB::commit();
            return response()->json(['success' => 'Lead Type updated successfully']);
        } catch (\Exception $e) {
            DB::rollback(); 
            return response()->json(['error' => 'Oops Something went wrong. Please try again later']);
        }
    }

    public function destroy($id)
    {
        DB::table("lead_types")->where('id', $id)->delete();
        return redirect()->route('lead_type.index')
            ->with('success', 'Lead Type deleted successfully');
    }
}
