<?php

namespace Gas\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    
    protected $fillable = [
        'company_name',
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
    
    public function clients() {
        return $this->hasMany(\Gas\Models\Client::class);
    }
    
    public function sellers() {
        return $this->hasMany(\Gas\Models\Seller::class);
    }
    
    public function sales() {
        return $this->hasMany(\Gas\Models\Sale::class);
    }
}
