<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirportBadge extends Model
{
    use HasFactory;
    protected $table = 'airport_badge';

    protected $fillable = [
        'employee_id',
        'security_front_id',
        'security_back_id',
        'privilege',
        'expire_date',
        'renew_date',
        'front_image',
        'back_image',
    ];

    // Define relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
