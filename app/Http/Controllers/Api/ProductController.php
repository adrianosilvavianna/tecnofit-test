<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    private $product;

    public function __construct (Product $product)
    {
        $this->product = $product;
    }

    // Cria Produto
    public function store(ProductRequest $request)
    {
        try{
            $product = $this->product->create($request->all());
            return new ProductResource($product);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 504);
        }
    }

    // Exibe Produto
    public function show(Product $product)
    {
        try{
            if(isset($product)){
                return new ProductResource($product);
            }
            throw new \Exception("Produto não existe", 504);
            
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 504);
        }
        
    }

    // Atualiza dados do produto
    public function update(Product $product, ProductRequest $request)
    {
        try{
            $product->update($request->all());
            return new ProductResource($product);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 504);
        }
        
    }

    // Exclui o produto [ Permanentimente pois está usando o softdelte ]
    public function destroy(Product $product)
    {
        try{
            if(isset($product)){
                return response()->json($product->delete());
            }
            throw new \Exception("Produto não existe", 504);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 504);
        }
    }

}
