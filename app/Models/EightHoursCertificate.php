<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EightHoursCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'certificate_id',
        'expire_date',
        'renew_date',
        'image',
    ];

    // Define the relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
