<?php

namespace Gas\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = 'sale_items';
    
    protected $fillable = [
        'product_id',
        'sale_id',
        'price',
        'quantity',
    ];
    
    public function sale() {
        return $this->belongsTo(\Gas\Models\Sale::class);
    }
}
