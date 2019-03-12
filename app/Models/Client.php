<?php

namespace Gas\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    
    protected $fillable = [
        'name',
        'company_name',
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
