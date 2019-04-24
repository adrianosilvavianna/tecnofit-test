<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    // Método de relacionamento [ManyToMany] com a tabela pivot product_order
    public function Products()
    {
        return $this->belongsToMany(Product::class, 'order_id', 'product_id');
    }
}
