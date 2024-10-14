<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Cart; // Make sure to include the Cart model
use App\Models\CartDetail;
use App\Models\OrderDetail;

class OrderObserver
{
    /**
     * Handle the Order "creating" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function creating(Order $order)
    {
        // Set the customer_code based on the selected cart_code
        if ($order->cart_code) {
            $cart = Cart::where('cart_code', $order->cart_code)->first();
            if ($cart) {
                $order->customer_code = $cart->customer_code; // Assuming customer_code is in the Cart table
            }

            // Calculate the total price based on the cart's details
            $totalPrice = CartDetail::where('cart_code', $order->cart_code)->sum('subtotal');
            $order->total_price = $totalPrice;
        }
    }

    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $cartDetails = CartDetail::where('cart_code', $order->cart_code)->get();

        foreach ($cartDetails as $cartDetail) {
            OrderDetail::create([
                'orderdetail_code' => 'OD' . str_pad(OrderDetail::count() + 1, 3, '0', STR_PAD_LEFT),
                'order_code' => $order->order_code,
                'product_code' => $cartDetail->product_code,
                'quantity' => $cartDetail->quantity,
                'subtotal' => $cartDetail->subtotal,
            ]);
        }
    }

    /**
     * Handle the Order "deleting" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleting(Order $order)
    {
        // Delete the associated order details if order is deleted
        OrderDetail::where('order_code', $order->order_code)->delete();
    }
}
