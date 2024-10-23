<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeLoginController extends Controller
{
    public function showLoginForm()
    {
        // print(Hash::make('John@EMP001'));
        // die;
        return view('auth.employee-login');
    }

    public function login(Request $request)
    {
        // Validate form data
        $request->validate([
            'employee_number' => 'required',
            'password' => 'required',
        ]);

        // Attempt to authenticate the employee
        if (Auth::guard('employee')->attempt([
            'employee_number' => $request->employee_number,
            'password' => $request->password
        ])) {
            // If successful, redirect to their intended page
            return redirect()->intended('/employee/dashboard');
        }

        // If authentication fails
        return back()->withErrors([
            'employee_number' => 'Invalid employee number or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('employee.login');
    }
}
