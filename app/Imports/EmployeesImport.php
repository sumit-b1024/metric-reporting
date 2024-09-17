<?php

namespace App\Imports;

use App\Models\Employee;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'employee_number' => $row['employee_number'],
            'first_name'      => $row['first_name'],
            'last_name'       => $row['last_name'],
            'email'           => $row['email'],
            'phone'           => $row['phone'],
            'employee_status' => $row['employee_status'],
            'date_of_birth'   => $this->transformDate($row['date_of_birth']),
            'hire_date'       => $this->transformDate($row['hire_date']),
            'comments'        => $row['comments'],
        ]);
    }

    /**
     * Transform the date to the correct format.
     *
     * @param string|null $value
     * @return string|null
     */
    private function transformDate($value)
    {
        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            // Return null or handle the error as needed if the date is invalid
            return null;
        }
    }
}
