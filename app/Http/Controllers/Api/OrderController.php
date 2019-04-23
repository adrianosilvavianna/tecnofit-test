<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
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

    public function store(OrderRequest $request)
    {
        try{
            $order = $this->order->create($request->all());
            return new OrderResource($order);
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

    }

    public function show(Order $order)
    {
        $order = $this->order->findOrFail($order);
        return new OrderResource($order);
    }


    public function update(Order $order, OrderRequest $request)
    {
        $order = $order->edit($request->all());
        return response()->json($order, 200);
    }

    public function destroy(Order $order)
    {
        return response()->json($order->delete());
    }

    public function relatonshipOrderProduct(Order $order, Product $product)
    {
        try{
            $order = $order->Products()->create(['product_id' => $product->id]);
            return new OrderResource($order);
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
}
