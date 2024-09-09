<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'created_by',
    ];

    protected $table = 'lead_types';
}
