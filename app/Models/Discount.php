<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discount';
    protected $fillable = [
        'code',
        'name',
        'type',
        'discount_amount',
        'start_date',
        'end_date',
        'status',
    ];
}
