<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LeadSource;
use Auth;

class LeadSourceController extends Controller
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
        $lead_sources = LeadSource::orderBy('id', 'ASC')->paginate(10);
        return view('lead_source.index', compact('lead_sources'));
    }

    public function create()
    {
        $lead_source = LeadSource::get();
        return view('lead_source.create', compact('lead_source'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:lead_sources,name',
        ]);
        DB::beginTransaction();
        try {
            $lead_source = LeadSource::create(['name' => $request->input('name'), 'status' => $request->input('status'), 'created_by' => Auth::user()->id]);
            DB::commit();
            return response()->json(['success' => 'Lead Source created successfully']);
        } catch (\Exception $e) {
            DB::rollback(); 
            return response()->json(['error' => 'Oops Something went wrong. Please try again later']);
        }
    }

    public function show($id)
    {
        $lead_source = LeadSource::find($id);
        
        if($lead_source)
            return response()->json(['status' => 'success', 'data' => ['lead_source' => json_encode($lead_source)]]);
        else
            return response()->json(['status' => 'error', 'data' => []]);
    }

    public function edit($id)
    {
        $lead_source = LeadSource::find($id);
        return view('lead_source.edit', compact('lead_source'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $lead_source = LeadSource::find($id);
            $lead_source->name = $request->input('name');
            $lead_source->status = $request->input('status');
            $lead_source->save();
            DB::commit();
            return response()->json(['success' => 'Lead Source updated successfully']);
        } catch (\Exception $e) {
            DB::rollback(); 
            return response()->json(['error' => 'Oops Something went wrong. Please try again later']);
        }
    }

    public function destroy($id)
    {
        DB::table("lead_sources")->where('id', $id)->delete();
        return redirect()->route('lead_source.index')
            ->with('success', 'Lead Source deleted successfully');
    }
}
