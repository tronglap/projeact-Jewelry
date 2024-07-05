<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $datas = Product::all();
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

        $products = DB::table('product')
            ->where('name', 'like', '%' . $searchTerm . '%')
            ->get();

        return response()->json($products);
    }

    public function error()
    {
        return view('client.pages.404');
    }
}
