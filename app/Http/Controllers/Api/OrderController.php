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
            $request = ['total' => 0, 'date' => date("Y-m-d") ];
            $order = $this->order->create($request);
            return new OrderResource($order);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 501);
        }

    }

    // Exibição dos dados do pedido
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    // Insere Produtos no Pedido
    public function update(Order $order, Request $request)
    {
        try{
            if(Product::find($request->product_id)){
                $order->Products()->attach(['product_id' => $request->product_id]);
                return new OrderResource($order);
            }
            throw new \Exception("Produto Não Existe", 501);

        }catch (\Exception $e){
            return response()->json(['error' =>  $e->getMessage()], 501);
        }
    }

    // Deleta Produtos do pedido
    public function destroy(Order $order, Request $request)
    {
        try{
            if(Product::find($request->product_id)){
                $order->Products()->detach($request->product_id);
                return response()->json(['deleted'], 200);
            }
            throw new \Exception("Produto Não Existe", 504);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 504);
        }
    }
}
