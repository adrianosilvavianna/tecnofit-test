<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $order;

    public function __construct (Order $order)
    {
        $this->order = $order;
    }

    // Método que cria o pedido
    public function store()
    {
        try{
            $request = ['total' => 0, 'date' => Date()->now() ];
            $order = $this->order->create($request->all());
            return new OrderResource($order);
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

    }

    // Exibição dos dados do pedido
    public function show(Order $order)
    {
        $order = $this->order->findOrFail($order);
        return new OrderResource($order);
    }

    // Insere Produtos no Pedido
    public function update(Order $order, Request $request)
    {
        try{

            if(Product::find($request->product_id)){
                $order = $order->Products()->attach(['product_id' => $request->product_id]);
                return new OrderResource($order);
            }
            throw new Exception("Produto Não Existe", 504);

        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('error', $e->getMessage(), 504);
        }
    }

    // Deleta Produtos do pedido
    public function destroy(Order $order, Request $request)
    {
        try{
            if(Product::find($request->product_id)){
                $order->Products()->detach($product->id);
                return response()->json(['deleted'], 200);
            }
            throw new Exception("Produto Não Existe", 504);
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('error', $e->getMessage(), 504);
        }
    }
}
