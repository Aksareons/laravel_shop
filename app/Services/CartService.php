<?php

namespace App\Services;
use App\Http\Requests\CartUpdateRequest;
use App\Http\Requests\DropItemRequest;
use \Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CartService
{
    /**
     * @param int $productId
     */
    public function addProduct(int $productId): void
    {
        $product = Product::find($productId); // assuming you have a Product model with id, name, description & price

      
        $cart_id =  \Session::getId();

            \Cart::session($cart_id);// the user ID to bind the cart content;s
        // add the product to cart
        $cartRow = \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'associatedModel' => Product::class
        ]);

    }

    /**
     * @param CartUpdateRequest $request
     */
    public function updateCart(CartUpdateRequest $request): void
    {
        $path = \Cart::session(\Session::getId());
        $path->update($request->id, [
            'quantity' => array(
            'relative' => false,
            'value' => $request->quantity),
           ]);
    }

    /**
     * @param DropItemRequest $request
     */
    public function dropItem(DropItemRequest $request): void
    {
        \Cart::session(\Session::getId())->remove($request->id);

    }

    /**
     * Destroy Cart
     */
    public function destroyCart(): void
    {
        Cart::session(\Session::getId())->clear();
    }
}