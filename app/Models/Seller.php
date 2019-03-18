<?php

namespace Gas\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Seller.
 *
 * @package namespace Gas\Models;
 */
class Seller extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sellers';
    
    protected $fillable = [
        'name',
        'document',
        'branch_id',
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
