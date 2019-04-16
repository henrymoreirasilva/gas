<?php

namespace Gas\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Branch.
 *
 * @package namespace Gas\Models;
 */
class Branch extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'branches';
    
    protected $fillable = [
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
