<?php

namespace App\Http\Controllers;

use App\Models\EightHoursCertificate;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Imports\EightHoursCertificatesImport;
use App\DataTables\EightHoursCertificateDataTable;
use Maatwebsite\Excel\Facades\Excel;

class EightHoursCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EightHoursCertificateDataTable $dataTable)
    {
        return $dataTable->render('eight_hours_certificates.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('eight_hours_certificates.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'certificate_id' => 'required|string|max:50',
            'expire_date' => 'required|date',
            'license_type' => 'nullable',
            'missing_annual_training' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $validatedData['image'] = $request->file('image')->store('images/eight_hours_certificates');

        EightHoursCertificate::create($validatedData);

        return redirect()->route('eight-hours-certificates.index')->with('success', '8-Hours Certificate added successfully.');
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
    public function edit(EightHoursCertificate $eightHoursCertificate)
    {
        $employees = Employee::all();
        return view('eight_hours_certificates.edit', compact('eightHoursCertificate', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EightHoursCertificate $eightHoursCertificate)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'certificate_id' => 'required|string|max:50',
            'expire_date' => 'required|date',
            'license_type' => 'nullable',
            'missing_annual_training' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images/eight_hours_certificates');
        }

        $eightHoursCertificate->update($validatedData);

        return redirect()->route('eight-hours-certificates.index')->with('success', '8-Hours Certificate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EightHoursCertificate $eightHoursCertificate)
    {
        $eightHoursCertificate->delete();
        return redirect()->route('eight-hours-certificates.index')->with('success', '8-Hours Certificate deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        try {
            Excel::import(new EightHoursCertificatesImport, $request->file('file'));
            return redirect()->route('eight-hours-certificates.index')->with('success', '8-Hours Certificates imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('eight-hours-certificates.index')->with('error', 'Error importing certificates: ' . $e->getMessage());
        }
    }
}
