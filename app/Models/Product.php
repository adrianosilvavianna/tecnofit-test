<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    // Essa Trait exclui o pedido permanentemente
    use SoftDeletes;

    protected $guarded = [];
}
