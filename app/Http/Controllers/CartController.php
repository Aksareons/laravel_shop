<?php

namespace App\Http\Controllers;
use App\Http\Requests\CartUpdateRequest;
use App\Http\Requests\DropItemRequest;
use \Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Services\CartService;


class CartController extends Controller
{
    private $cartService;

    
    public function __construct(CartService $cartService)
    {
        return $this->cartService = $cartService;
    }


    public function index()
    {
        $res = \Cart::session(\Session::getId())->getContent();     
        return view('cart.index', compact('res'));
    }

    
    public function add($idProduct)
    {
        $this->cartService->addProduct($idProduct);
        return redirect()->back();
    }


    public function update(CartUpdateRequest $request)
    {
        $this->cartService->updateCart($request);
        return redirect()->back();
    }

    
    public function drop(DropItemRequest $request)
    {
        $this->cartService->dropItem($request);
        return redirect()->back();
    }

    
    public function destroy()
    {
        $this->cartService->destroyCart();
        return redirect()->back();
    }

    
    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view ('cart.success', compact('order'));
    }
    
    
    public function checkout()
    {
        return view ('orders.checkout');
    }
}
