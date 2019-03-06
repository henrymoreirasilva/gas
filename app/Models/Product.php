<?php

namespace Gas\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'description',
        'unidade',
        'sale_price',
        'cost_price',
        'situation'
    ];
}
