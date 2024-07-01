<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;


class DetailProductController extends Controller
{
    public function index(Product $product)
    {
        $datas = Product::with('productCategory')->get();
        return view('client.pages.product.detail', ['datas' => $datas, 'product' => $product]);
    }
}