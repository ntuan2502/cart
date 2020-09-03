<?php

namespace App\Providers;

use App\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $cart_taxValue = config('cart.tax');
            $discount = session()->get('coupon')['discount'] ?? 0;
            $coupon_name = session()->get('coupon')['name'] ?? '';
            $cart_content = Cart::content();
            $cart_count = Cart::count();
            foreach ($cart_content as $item) {
                $item->vnd_price = pricetoVND($item->model->price);
                $item->vnd_subtotal = pricetoVND($item->subtotal);
            }
            $cart_subtotal = Cart::subtotal();
            $cart_newSubtotal = $cart_subtotal - $discount;
            $cart_newTax = $cart_newSubtotal * $cart_taxValue / 100;
            $cart_newTotal = $cart_newSubtotal + $cart_newTax;
            $categories = Category::all();
            $view->with([
                'cart_taxValue' => $cart_taxValue . '%',
                'cart_content' => $cart_content,
                'cart_count' => $cart_count,
                'cart_subtotal' => pricetoVND($cart_subtotal),
                'cart_newSubtotal' => pricetoVND($cart_newSubtotal),
                'cart_newTax' => pricetoVND($cart_newTax),
                'cart_newTotal' => pricetoVND($cart_newTotal),
                'categories' => $categories,
                'coupon_name' => $coupon_name,
                'discount' => pricetoVND($discount),
            ]);
        });
    }
}
