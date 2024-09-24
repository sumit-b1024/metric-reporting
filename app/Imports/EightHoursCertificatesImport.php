<?php

namespace App\Imports;

use App\Models\EightHoursCertificate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class EightHoursCertificatesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EightHoursCertificate([
            'employee_id' => isset($row['employee_id']) ? $row['employee_id'] : null,
            'certificate_id' => isset($row['certificate_id']) ? $row['certificate_id'] : null,
            'expire_date' => isset($row['expire_date']) ? Carbon::parse($row['expire_date'])->format('Y-m-d') : null,
            'license_type' => isset($row['renew_date']) ? $row['license_type'] : null,
            'missing_annual_training' => isset($row['missing_annual_training']) ? $row['missing_annual_training'] : null,
            'image' => isset($row['image']) ? $row['image'] : null, // Assuming the image already exists on the server
        ]);
    }
}
