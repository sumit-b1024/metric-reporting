<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmployeesImport implements ToModel, WithHeadingRow
{
    /**
     * Map the Excel row to the Employee model.
     */
    public function model(array $row)
    {
        if(!empty( $row['first_name']))
        return Employee::updateOrCreate(
            ['employee_number' => $row['employee_number']],  // Unique field to identify the employee
            [
                'first_name'         => $row['first_name'],
                'last_name'          => $row['last_name'],
                'employee_status'    => $row['employee_status'],
                'date_of_birth'      => $this->formatDate($row['date_of_birth']),  // Convert date format
                'hire_date'          => $this->formatDate($row['hire_date']),  // Convert date format
                'seniority_date'     => $this->formatDate($row['32bj_seniority_date']),  // Convert date format
                'phone'              => $row['phone'] ?? null,
                'email'              => $row['email'] ?? null,
                'uniform_pant_size'  => $row['uniform_pant_size'] ?? null,
                'uniform_shirt_size' => $row['uniform_shirt_size'] ?? null,
                'comments'           => $row['comments'] ?? null,
            ]
        );
    }

    private function formatDate($date)
{
    // Check if the date is numeric (Excel stores dates as numeric values)
    if (is_numeric($date)) {
        try {
            // Convert Excel date serial number to a valid Carbon date
            return Carbon::instance(Date::excelToDateTimeObject($date))->format('Y-m-d');
        } catch (\Exception $e) {
            // Return null if conversion fails
            return null;
        }
    } elseif (!empty($date)) {
        // If it's not a number, assume it's already in a valid date format
        try {
            // Attempt to parse and format the date
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            // Return null if the date parsing fails
            return null;
        }
    }

    // Return null if the date is empty or invalid
    return null;
}
}
