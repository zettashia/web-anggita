<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_no',
        'customer_id',
        'order_date',
        'subtotal',
        'discount_id',
        'discount',
        'total_amount',
        'payment_method',
        'bank_name',
        'card_number',
        'payment_status',
        'status',
        'delivered_date'
    ];

    public function items(){
        return $this->hasMany(OrderDetail::class);
    }
}
