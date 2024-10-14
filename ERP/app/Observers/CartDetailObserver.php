<?php

namespace App\Observers;

use App\Models\CartDetail;
use App\Models\Product;
use App\Models\Cart;

class CartDetailObserver
{
    /**
     * Handle the CartDetail "saving" event.
     *
     * @param  \App\Models\CartDetail  $cartDetail
     * @return void
     */
    public function saving(CartDetail $cartDetail)
    {
        // Get the product price from the database
        $productPrice = Product::where('product_code', $cartDetail->product_code)->value('price');

        // Calculate the subtotal
        if ($productPrice !== null) {
            $cartDetail->subtotal = $cartDetail->quantity * $productPrice;
        } else {
            $cartDetail->subtotal = 0; // Handle case where product price is not found
        }
    }

    /**
     * Handle the CartDetail "saved" event.
     *
     * @param  \App\Models\CartDetail  $cartDetail
     * @return void
     */
    public function saved(CartDetail $cartDetail)
    {
        // Trigger update of the cart's total price
        $this->updateCartTotal($cartDetail->cart_code);
    }

    /**
     * Handle the CartDetail "deleted" event.
     *
     * @param  \App\Models\CartDetail  $cartDetail
     * @return void
     */
    public function deleted(CartDetail $cartDetail)
    {
        // Trigger update of the cart's total price
        $this->updateCartTotal($cartDetail->cart_code);
    }

    /**
     * Update the total price of the cart.
     *
     * @param string $cartCode
     * @return void
     */
    protected function updateCartTotal(string $cartCode)
    {
        // Calculate the new total price based on related cart details
        $totalPrice = CartDetail::where('cart_code', $cartCode)->sum('subtotal');

        // Update the cart's total_price
        Cart::where('cart_code', $cartCode)->update(['total_price' => $totalPrice]);
    }
}
