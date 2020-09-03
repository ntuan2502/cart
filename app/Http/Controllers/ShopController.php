<?php

namespace App\Http\Controllers;

use App\Classify;
use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 9;
        if (request()->classify) {
            $classify = Classify::where('slug', request()->classify)->first();
            $queryProduct = Product::where('classify_id', $classify->id);
            $products = $queryProduct;
            $countProducts = $queryProduct->count();
        } else {
            $queryProduct = Product::where([]);
            $products = $queryProduct->inRandomOrder();
            $countProducts = $queryProduct->count();
        }
        $products = $products->paginate($pagination);

        foreach ($products as $product) {
            $product->vnd_price = pricetoVND($product->price);
        }
        
        return view('shop')->with([
            'products' => $products,
            'countProducts' => $countProducts,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('slug', '!=', $slug)->relatedProducts()->get();

        $product->vnd_price = pricetoVND($product->price);
        foreach ($relatedProducts as $relatedProduct) {
            $relatedProduct->vnd_price = pricetoVND($relatedProduct->price);
        }

        return view('product')->with([
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
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
    public function destroy($id)
    {
        //
    }
}
