<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;


class DetailProductController extends Controller
{
    public function index(Product $product)
    {
        $datas = Product::with('productCategory')
            ->where('status', '!=', 'hide')
            ->where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->get();

        return view('client.pages.product.detail', ['datas' => $datas, 'product' => $product]);
    }
}
