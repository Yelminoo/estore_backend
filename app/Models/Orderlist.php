<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'total_price',
        'order_code',
        'qty',
    ];
}