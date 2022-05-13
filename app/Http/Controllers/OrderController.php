<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;

use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;
use \Auth;

use App\Services\OrderService;
class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::all();
       
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        
        $order = $this->orderService->storeOrder($request);
        return redirect()->route('cart.success', ['orderId' => $order->id]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orderItem = OrderItem::where('order_id', $order->id)->get();
        return view('admin.orders.show', compact('order', 'orderItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
