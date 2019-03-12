<?php

namespace Gas\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    
    protected $fillable = [
        'client_id',
        'seller_id',
        'branch_id',
        'sale_date',
        'payment_date',
        'amount',
        'discount_value',
        'value_addition',
        'payment_form',
        'plots',
        'situation',
    ];
    
    public function client() {
        return $this->belongsTo(\Gas\Models\Client::class);
    }
    
    public function branch() {
        return $this->belongsTo(\Gas\Models\Branch::class);
    }

    public function seller() {
        return $this->belongsTo(\Gas\Models\Seller::class);
    }
    
    public function items() {
        return $this->hasMany(\Gas\Models\SaleItem::class);
    }
}
