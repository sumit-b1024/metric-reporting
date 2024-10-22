<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\User;

class EmployeeObserver
{
    /**
     * Generate default password.
     */
    public static function getPassword()
    {
        return '12345678'; // Or use a more secure generation method
    }
 
    /**
     * Handle the Employee "saving" event (before update or create).
     */
    public function saving(Employee $employee)
    {
        if(empty($employee->email))
        {
            return ; 
        }
        // Find the user based on the employee's email
        $user = User::where('email', $employee->email)->first();

        if ($user) {
            // Update the user details if the user exists
            $user->update([
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'email' => $employee->email, // Only update if necessary
                'phone'=>$employee->phone,
            ]);
        } else {
            // Create a new user if it doesn't exist
            $user = User::create([
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'email' => $employee->email,
                'phone'=>$employee->phone,
                'password' => bcrypt(self::getPassword()), // Set default password
            ]);

            // Assign the 'employee' role to the new user
            $user->assignRole('employee');
        }
    }

    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(Employee $employee)
    {
        // Delete the corresponding user when an employee is deleted
        User::where('email', $employee->email)->delete();
    }
}
