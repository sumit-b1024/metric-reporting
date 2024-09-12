<?php 

namespace App\Http\Controllers;

use App\DataTables\EmployeesDataTable;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees using DataTables.
     *
     * @param EmployeesDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeesDataTable $dataTable)
    {
      //  dd($dataTable);
        // Render the DataTable in the view
        return $dataTable->render('employees.index');
    }

    /**
     * Show the form for creating a new employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created employee in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'employee_number' => 'required|unique:employees,employee_number|max:20',
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'employee_status' => 'required|max:20',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'seniority_date' => 'required|date',
            'phone' => 'nullable|max:15',
            'email' => 'nullable|email|max:100',
            'uniform_pant_size' => 'nullable|max:10',
            'uniform_shirt_size' => 'nullable|max:10',
            'comments' => 'nullable'
        ]);

        // Create the new employee record
        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified employee.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        // Validate the request
        $request->validate([
            'employee_number' => 'required|unique:employees,employee_number,' . $employee->id . '|max:20',
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'employee_status' => 'required|max:20',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'seniority_date' => 'required|date',
            'phone' => 'nullable|max:15',
            'email' => 'nullable|email|max:100',
            'uniform_pant_size' => 'nullable|max:10',
            'uniform_shirt_size' => 'nullable|max:10',
            'comments' => 'nullable'
        ]);

        // Update the employee record
        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified employee from storage.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        // Delete the employee
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
