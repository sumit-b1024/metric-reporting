<?php

namespace App\Imports;

use App\Models\AirportBadge;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AirportBadgesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AirportBadge([
            'employee_id' => $row['employee_id'],
            'security_front_id' => $row['security_front_id'],
            'security_back_id' => $row['security_back_id'],
            'privilege' => $row['privilege'],
            'expire_date' => Carbon::parse($row['expire_date'])->format('Y-m-d'),
            'renew_date' => isset($row['renew_date']) ? Carbon::parse($row['renew_date'])->format('Y-m-d') : null,
            'front_image' => $row['front_image'],
            'back_image' => $row['back_image'],
        ]);
    }
}
