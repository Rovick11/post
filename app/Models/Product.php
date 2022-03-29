<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'image',
        'barcode',
        'price',
        'quantity',
        'status'
    ];
}
