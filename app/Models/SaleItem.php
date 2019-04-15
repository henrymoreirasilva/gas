<?php

namespace Gas\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class SaleItem.
 *
 * @package namespace Gas\Models;
 */
class SaleItem extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
    public function product() {
        return $this->belongsTo(\Gas\Models\Product::class);
    }
}
