<?php

namespace App\Http\Controllers;

use App\Models\DrivingLicense;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Imports\DrivingLicensesImport;
use App\DataTables\DrivingLicenseDataTable;
use Maatwebsite\Excel\Facades\Excel;


class DrivingLicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DrivingLicenseDataTable $dataTable)
    {
        return $dataTable->render('driving_licenses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('driving_licenses.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'driving_id' => 'required|string|max:50',
            'expire_date' => 'required|date',
            'renew_date' => 'nullable|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $validatedData['image'] = $request->file('image')->store('images/driving_licenses');

        DrivingLicense::create($validatedData);

        return redirect()->route('driving-licenses.index')->with('success', 'Driving License added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DrivingLicense $drivingLicense)
    {
        $employees = Employee::all();
        return view('driving_licenses.edit', compact('drivingLicense', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DrivingLicense $drivingLicense)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'driving_id' => 'required|string|max:50',
            'expire_date' => 'required|date',
            'renew_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images/driving_licenses');
        }

        $drivingLicense->update($validatedData);

        return redirect()->route('driving-licenses.index')->with('success', 'Driving License updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DrivingLicense $drivingLicense)
    {
        $drivingLicense->delete();
        return redirect()->route('driving-licenses.index')->with('success', 'Driving License deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        try {
            Excel::import(new DrivingLicensesImport, $request->file('file'));
            return redirect()->route('driving-licenses.index')->with('success', 'Driving Licenses imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('driving-licenses.index')->with('error', 'Error importing licenses: ' . $e->getMessage());
        }
    }
}
