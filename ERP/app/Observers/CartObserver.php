<?php

namespace App\Observers;

use App\Models\Cart;
use App\Models\CartDetail;

class CartObserver
{
    /**
     * Handle the Cart "created" event. // Might not be needed since default total_price value is 0? idk
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function created(Cart $cart)
    {
        $this->updateTotalPrice($cart);
    }

    /**
     * Handle the Cart "updated" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function updated(Cart $cart)
    {
        $this->updateTotalPrice($cart);
    }

    /**
     * Update the total price of the cart based on its details.
     *
     * @param \App\Models\Cart $cart
     * @return void
     */
    protected function updateTotalPrice(Cart $cart)
    {
        $totalPrice = CartDetail::where('cart_code', $cart->cart_code)->sum('subtotal');
        $cart->total_price = $totalPrice;
        $cart->saveQuietly(); // Save quietly to prevent triggering the updated observer again
    }
}
