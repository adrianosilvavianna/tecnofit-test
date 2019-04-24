<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct (Product $product)
    {
        $this->product = $product;
    }

    // Cria Produto
    public function store(Product $request)
    {
        try{
            $order = $this->product->create($request->all());
            return new ProductResource($order);
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    // Exibe Produto
    public function show(Product $product)
    {
        $order = $this->product->findOrFail($product);
        return new ProductResource($order);
    }

    // Atualiza dados do produto
    public function update(Product $product, ProductResource $request)
    {
        $order = $product->edit($request->all());
        return response()->json($order, 200);
    }

    // Exclui o produto [ Permanentimente pois está usando o softdelte ]
    public function destroy(Product $product)
    {
        return response()->json($product->delete());
    }

}
