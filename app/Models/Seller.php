<?php

namespace Gas\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = 'sellers';
    
    protected $fillable = [
        'name',
        'document',
        'phone',
        'email',
        'address',
        'complement',
        'address_number',
        'city',
        'state',
        'zip_code',
        'active'
    ];
    
    public function branch() {
        return $this->belongsTo(\Gas\Models\Branch::class);
    }
    
    public function sales() {
        return $this->hasMany(\Gas\Models\Sale::class);
    }
}
