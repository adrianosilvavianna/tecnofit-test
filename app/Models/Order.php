<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function Products()
    {
        return $this->belongsToMany(Product::class, 'order_id', 'product_id');
    }
}
