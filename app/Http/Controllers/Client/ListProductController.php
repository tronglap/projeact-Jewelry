<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ProductCategory;

class ListProductController extends Controller
{
    public function index(Request $request)
    {
        $itemPerPage = config('myconfig.product_per_page', 20);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $itemPerPage;
        $categoryId = $request->input('category', null);

        $query = Product::query();
        $query->where('status', '!=', 'hide');
        $totalProducts = $query->count();

        $query->offset($offset)->limit($itemPerPage);
        $datas = $query->get();

        if ($categoryId) {
            $query->where('product_category_id', $categoryId);
            $totalProducts = $query->count();
            $datas = $query->offset($offset)->limit($itemPerPage)->get();
        }

        $productCategories = ProductCategory::all();

        $categoryProductCounts = $this->countProductsByCategory();

        return view('client.pages.product.list', [
            'categoryProductCounts' => $categoryProductCounts,
            'productCategories' => $productCategories,
            'datas' => $datas,
            'totalProducts' => $totalProducts,
            'itemPerPage' => $itemPerPage,
            'currentPage' => $currentPage,
            'selectedCategory' => $categoryId
        ]);
    }

    private function countProductsByCategory()
    {
        return Product::where('status', '!=', 'hide')
            ->select('product_category_id', DB::raw('count(*) as total'))
            ->groupBy('product_category_id')
            ->pluck('total', 'product_category_id');
    }
}
