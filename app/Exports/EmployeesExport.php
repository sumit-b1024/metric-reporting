<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeesExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
     * Return all employees for export.
     */
    public function collection()
    {
        return Employee::select(
            'employee_number',
            'first_name',
            'last_name',
            'employee_status',
            'date_of_birth',
            'hire_date',
            'seniority_date',
            'phone',
            'email',
            'uniform_pant_size',
            'uniform_shirt_size'
        )->get();
    }

    /**
     * Define the headings for the exported file.
     */
    public function headings(): array
    {
        return [
            'Employee Number',
            'First Name',
            'Last Name',
            'Employee Status',
            'Date of Birth',
            'Hire Date',
            '32BJ Seniority Date',
            'Phone',
            'Email',
            'Uniform Pant Size',
            'Uniform Shirt Size',
        ];
    }

    /**
     * Style the header row.
     */
    public function styles(Worksheet $sheet)
    {
        // Apply red text color to header row
        return [
            1 => ['font' => ['color' => ['rgb' => 'FF0000'], 'bold' => true]], // Red color, bold headers
        ];
    }

    /**
     * Adjust the column widths based on content length.
     */
    public function columnWidths(): array
    {
        return [
            'A' => 20,  // Employee Number
            'B' => 20,  // First Name
            'C' => 20,  // Last Name
            'D' => 15,  // Employee Status
            'E' => 15,  // Date of Birth
            'F' => 15,  // Hire Date
            'G' => 18,  // Seniority Date
            'H' => 20,  // Phone
            'I' => 30,  // Email
            'J' => 15,  // Uniform Pant Size
            'K' => 15,  // Uniform Shirt Size
        ];
    }
}
