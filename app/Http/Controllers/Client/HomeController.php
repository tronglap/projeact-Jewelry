<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $datas = Product::where('status', '<>', 'hide')
            ->join('order_item', 'product.id', '=', 'order_item.product_id')
            ->select('product.*', DB::raw('SUM(order_item.quantity) as total_quantity'))
            ->groupBy('product.id')
            ->orderBy('total_quantity', 'desc')
            ->limit(20)
            ->get();

        $blog = Blog::all();
        return view('client.pages.home', [
            'datas' => $datas,
            'blog' => $blog,
            'isHome' => true
        ]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $products = Product::where('name', 'like', '%' . $searchTerm . '%')
            ->where('status', '!=', 'hide')
            ->get();

        return response()->json($products);
    }

    public function error()
    {
        return view('client.pages.404');
    }
}