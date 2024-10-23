<?php 

namespace App\Http\Controllers;

use App\DataTables\EmployeesDataTable;
use App\Models\Employee;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use Illuminate\Support\Facades\Auth;

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
        $validatedData = $request->validate([
            'employee_number' => 'required|unique:employees,employee_number|max:20',
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'employee_status' => 'required|max:20',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'phone' => 'nullable|max:15',
            'email' => 'nullable|email|max:100',
            'uniform_pant_size' => 'nullable|max:10',
            'uniform_shirt_size' => 'nullable|max:10',
            'comments' => 'nullable'
        ]);

        $validatedData['password'] = $request->get('first_name').'@'.$request->get('employee_number');

        // Create the new employee record
        Employee::create($validatedData);

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
            'phone' => 'nullable|max:15',
            'email' => 'nullable|email|max:100',
            'uniform_pant_size' => 'nullable|max:10',
            'uniform_shirt_size' => 'nullable|max:10',
            'comments' => 'nullable'
        ]);
        $data = $request->all();
        $data['password'] = $request->get('first_name').'@'.$request->get('employee_number');
        // Update the employee record
        $employee->update($data);

        if(Auth::guard('employee')->check() === true)
        {
            return redirect()->route('employee.dashboard')->with('success', 'Employee updated successfully.');
        }

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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx|max:2048', // Validate file type and size
        ]);
    
        try {
            Excel::import(new EmployeesImport, $request->file('file'));
    
            return redirect()->route('employees.index')->with('success', 'Employees imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error', 'Error importing employees: ' . $e->getMessage());
        }
    }

     /**
     * Export Employees as CSV.
     */
    public function exportCsv()
    {
        return Excel::download(new EmployeesExport, 'employees.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    /**
     * Export Employees as Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }
}
