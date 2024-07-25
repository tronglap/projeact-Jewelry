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

        $sortByOption = $request->input('sortByOption', null);
        $searchKey = $request->input('key', null);
        $priceFrom = $request->input('price_from', null);
        $priceTo = $request->input('price_to', null);

        $query = Product::query();
        $query->where('status', '!=', 'hide');

        if ($categoryId) {
            $query->where('product_category_id', $categoryId);
        }

        if ($searchKey) {
            $query->where('name', 'like', "%$searchKey%");
        }

        if ($priceFrom) {
            $query->where(function ($q) use ($priceFrom) {
                $q->whereRaw('COALESCE(promotion, price) >= ?', [$priceFrom]);
            });
        }

        if ($priceTo) {
            $query->where(function ($q) use ($priceTo) {
                $q->whereRaw('COALESCE(promotion, price) <= ?', [$priceTo]);
            });
        }

        if ($sortByOption) {
            switch ($sortByOption) {
                case '1':
                    $query->orderBy('name', 'asc');
                    break;
                case '2':
                    $query->orderBy('name', 'desc');
                    break;
                case '3':
                    $query->orderByRaw('COALESCE(promotion, price) asc');
                    break;
                case '4':
                    $query->orderByRaw('COALESCE(promotion, price) desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderByRaw('(quantity < 10) asc')
                ->orderBy('created_at', 'desc');
        }

        $totalProducts = $query->count();
        $datas = $query->offset($offset)->limit($itemPerPage)->get();

        // if ($request->ajax()) {
        //     return view('client.components.product_list', ['datas' => $datas])->render();
        // }

        if ($request->ajax()) {
            $productCountStart = ($currentPage - 1) * $itemPerPage + 1;
            $productCountEnd = min($currentPage * $itemPerPage, $totalProducts);
            $html = view('client.components.product_list', ['datas' => $datas])->render();

            return response()->json([
                'html' => $html,
                'totalProducts' => $totalProducts,
                'productCountStart' => $productCountStart,
                'productCountEnd' => $productCountEnd
            ]);
        }

        $productCategories = ProductCategory::where('status', '!=', 'hide')->get();
        $categoryProductCounts = $this->countProductsByCategory();

        return view('client.pages.product.list', [
            'categoryProductCounts' => $categoryProductCounts,
            'productCategories' => $productCategories,
            'datas' => $datas,
            'totalProducts' => $totalProducts,
            'itemPerPage' => $itemPerPage,
            'currentPage' => $currentPage,
            'selectedCategory' => $categoryId,
            'sortByOption' => $sortByOption,
            'searchKey' => $searchKey,
            'priceFrom' => $priceFrom,
            'priceTo' => $priceTo,
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
