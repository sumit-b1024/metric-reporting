<?php

namespace App\Http\Controllers;

use App\Models\SecurityGuardLicense;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Imports\SecurityGuardLicensesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\SecurityGuardLicenseDataTable;

class SecurityGuardLicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SecurityGuardLicenseDataTable $dataTable)
    {
        return $dataTable->render('security_guard_licenses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('security_guard_licenses.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'security_id' => 'required|string|max:50',
            'security_status' => 'required|string|max:100',
            'license_type' => 'required|string|max:100',
            'renew_date' => 'nullable|date',
            'expire_date' => 'required|date',
            'link' => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $validatedData['image'] = $request->file('image')->store('images/security_guard_licenses');

        SecurityGuardLicense::create($validatedData);

        return redirect()->route('security-guard-licenses.index')->with('success', 'Security Guard License added successfully.');
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
    public function edit(SecurityGuardLicense $securityGuardLicense)
    {
        $employees = Employee::all();
        return view('security_guard_licenses.edit', compact('securityGuardLicense', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SecurityGuardLicense $securityGuardLicense)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'security_id' => 'required|string|max:50',
            'security_status' => 'required|string|max:100',
            'license_type' => 'required|string|max:100',
            'renew_date' => 'nullable|date',
            'expire_date' => 'required|date',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images/security_guard_licenses');
        }

        $securityGuardLicense->update($validatedData);

        return redirect()->route('security-guard-licenses.index')->with('success', 'Security Guard License updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SecurityGuardLicense $securityGuardLicense)
    {
        $securityGuardLicense->delete();
        return redirect()->route('security-guard-licenses.index')->with('success', 'Security Guard License deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        try {
            Excel::import(new SecurityGuardLicensesImport, $request->file('file'));
            return redirect()->route('security-guard-licenses.index')->with('success', 'Security Guard Licenses imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('security-guard-licenses.index')->with('error', 'Error importing licenses: ' . $e->getMessage());
        }
    }
}
