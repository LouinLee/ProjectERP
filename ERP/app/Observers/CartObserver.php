<?php

namespace App\Observers;

use App\Models\Cart;
use App\Models\CartDetail;

class CartObserver
{
    /**
     * Handle the Cart "created" event.
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
     * Handle the Cart "deleted" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function deleting(Cart $cart)
    {
        // Optionally clean up cart details
        CartDetail::where('cart_code', $cart->cart_code)->delete();
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
        $cart->saveQuietly(); // Avoid triggering other observers
    }
}
