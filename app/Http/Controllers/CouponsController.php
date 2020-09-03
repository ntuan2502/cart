<?php

namespace App\Http\Controllers;

use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if (!$coupon) {
            return redirect()->route('cart.index')->withErrors('Invalid coupon code. Please try again.');
        }
        $discount = 0;
        if ($coupon->type == 'fixed') {
            if (Cart::subtotal() < $coupon->min_price) {
                return redirect()->route('cart.index')->withErrors('Giá tiền nhỏ hơn yêu cầu coupon.');
            } else {
                $discount = $coupon->discount(Cart::subtotal());
            }
        } elseif ($coupon->type == 'percent') {
            if ($coupon->discount(Cart::subtotal()) > $coupon->max_discount) {
                $discount = $coupon->max_discount;
            } else {
                $discount = $coupon->discount(Cart::subtotal());
            }
        }
        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $discount,
        ]);

        return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');
        return redirect()->route('cart.index');
    }
}
