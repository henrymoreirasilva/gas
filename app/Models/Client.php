<?php

namespace Gas\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Client.
 *
 * @package namespace Gas\Models;
 */
class Client extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
