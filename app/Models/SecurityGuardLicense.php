<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityGuardLicense extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'security_id',
        'security_status',
        'license_type',
        'renew_date',
        'expire_date',
        'link',
        'image',
    ];

    // Define the relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
