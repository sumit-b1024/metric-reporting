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
            'employee_id' => $row['employee_id'],
            'certificate_id' => $row['certificate_id'],
            'expire_date' => Carbon::parse($row['expire_date'])->format('Y-m-d'),
            'renew_date' => isset($row['renew_date']) ? Carbon::parse($row['renew_date'])->format('Y-m-d') : null,
            'image' => $row['image'], // Assuming the image already exists on the server
        ]);
    }
}
