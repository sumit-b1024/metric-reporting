<?php

namespace App\Imports;

use App\Models\SecurityGuardLicense;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class SecurityGuardLicensesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SecurityGuardLicense([
            'employee_id' => $row['employee_id'],
            'security_id' => $row['security_id'],
            'security_status' => $row['security_status'],
            'license_type' => $row['license_type'],
            'renew_date' => isset($row['renew_date']) ? Carbon::parse($row['renew_date'])->format('Y-m-d') : null,
            'expire_date' => Carbon::parse($row['expire_date'])->format('Y-m-d'),
            'link' => $row['link'],
            'image' => $row['image'],
        ]);
    }
}
