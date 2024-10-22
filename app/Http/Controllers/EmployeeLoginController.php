<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.employee-login'); // Create a separate view for employee login
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('employee')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->remember)) {
            // Redirect to employee dashboard or whatever you want
            return redirect()->intended(route('employee.dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect('/'); // Redirect to homepage or employee login page
    }
}
