<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AirportBadge;
use App\Models\Employee;
use App\Imports\AirportBadgesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\AirportBadgeDataTable;

class AirportBadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AirportBadgeDataTable $dataTable)
    {
        return $dataTable->render('airport-badges.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('airport-badges.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'privilege' => 'required|string|max:100',
            'security_front_id' => 'required|string|max:50',
            'security_back_id' => 'required|string|max:50',
            'expire_date' => 'required|date',
            'renew_date' => 'nullable|date|after_or_equal:expire_date',
            'image_front' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_back' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file uploads
        $validatedData['front_image'] = $request->file('image_front')->store('images/airport-badge');
        $validatedData['back_image'] = $request->file('image_back')->store('images/airport-badge');

        // Create a new airport badge
        AirportBadge::create($validatedData);

        return redirect()->route('airport-badge.index')->with('success', 'Airport SIDA Badge added successfully.');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(AirportBadge $airportBadge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AirportBadge $airportBadge)
    {
        $employees = Employee::all();
        return view('airport-badges.edit', compact('airportBadge', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AirportBadge $airportBadge)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'privilege' => 'required|string|max:100',
            'security_front_id' => 'required|string|max:50',
            'security_back_id' => 'required|string|max:50',
            'expire_date' => 'required|date',
            'renew_date' => 'nullable|date|after_or_equal:expire_date',
            'image_front' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_back' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file uploads if new files are uploaded
        if ($request->hasFile('image_front')) {
            $validatedData['front_image'] = $request->file('image_front')->store('images/front');
        } else {
            $validatedData['front_image'] = $airportBadge->image_front;
        }

        if ($request->hasFile('image_back')) {
            $validatedData['back_image'] = $request->file('image_back')->store('images/back');
        } else {
            $validatedData['back_image'] = $airportBadge->image_back;
        }

        // Update the badge with the validated data
        $airportBadge->update($validatedData);

        return redirect()->route('airport-badge.index')->with('success', 'Airport SIDA Badge updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AirportBadge $airportBadge)
    {
        $airportBadge->delete();
        return redirect()->route('airport-badge.index')->with('success', 'Airport badge deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        try {
            Excel::import(new AirportBadgesImport, $request->file('file'));
            return redirect()->route('airport-badge.index')->with('success', 'Airport Badges imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('airport-badge.index')->with('error', 'Error importing badges: ' . $e->getMessage());
        }
    }
}
