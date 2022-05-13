<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;

use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;
use \Auth;
use  App\Mail\RegistrationMail;
use \Mail;
use App\Jobs\OrderMail;


class OrderService
{
    /**
     * @param StoreOrderRequest $request
     * @return Order
     */
    public function storeOrder(StoreOrderRequest $request): Order
    {
        $orderItem;
        $order = Order::create([
            'customerName' => $request->customerName,
            'customerLastName' => $request->customerLastName,
            'customerEmail' => $request->customerEmail,
            'customerPhone' => $request->customerPhone,
            'customerAddress' => $request->customerAddress,
            'comment' => $request->customerComment,
            'total' => \Cart::session(\Session::getId())->getTOtal(),
        ]);
        $orderItem = \Cart::getContent();
        foreach (\Cart::getContent() as $cartRow) {
                OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartRow->model->id,
                'price' => $cartRow->model->price,
                'quantity' => $cartRow->quantity,
            ]);
        }

        if ($request->has('updateUser')) {
            $user = Auth::user() ? Auth::user() : User::where('email', $request->customerEmail)->first();
            if (!is_null($user)) {
                $user->update([
                    'name' => $request->customerName,
                    'lastname' => $request->customerLastName,
                    'email' => $request->customerEmail,
                    'phone' => $request->customerPhone,
                    'address' => $request->customerAddress,
                ]);

                $order->update([
                    'user_id' => $user->id,
                ]);
            }
        }
        \Cart::session(\Session::getId())->clear();
        OrderMail::dispatch($order, $orderItem);
        // Mail::to($request->customerEmail)->queue(new RegistrationMail($order, $orderItem));
        return $order;
    }
}