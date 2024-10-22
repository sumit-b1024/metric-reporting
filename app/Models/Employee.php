<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_number',
        'last_name',
        'first_name',
        'employee_status',
        'date_of_birth',
        'hire_date',
        'phone',
        'email',
        'uniform_pant_size',
        'uniform_shirt_size',
        'comments',
        'user_id',  // Added user_id to link the User model
    ];

    /**
     * Relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
