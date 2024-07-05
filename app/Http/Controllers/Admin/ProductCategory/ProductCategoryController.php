<?php

namespace App\Http\Controllers\Admin\ProductCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryStoreRequest;
use App\Http\Requests\ProductCategoryUpdateRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function create()
    {
        return view('admin.pages.productCategory.create');
    }

    public function store(ProductCategoryStoreRequest $request)
    {
        $checkNameIsExists = DB::table('product_category')->where('name', $request->name)->exists();

        if ($checkNameIsExists) {
            return redirect()->route('admin.product_category.create')->with('message', 'Name is exists!');
        } else {
            $result = DB::table('product_category')->insert([
                'name' => $request->name,
                'slug' => $request->slug,
                'status' => $request->status
            ]);

            if ($result) {
                return redirect()->route('admin.product_category.create')->with('message', 'Create Category Success!');
            } else {
                return redirect()->route('admin.product_category.create')->with('message', 'Create Category fail!');
            }
        }
    }


    public function index(Request $request)
    {
        $key = $request->key ?? null;
        $sortBy = $request->sortBy ?? 'latest';

        if (is_null($key)) {
            $datas = ProductCategory::withTrashed();
        } else {
            $datas = ProductCategory::withTrashed()
                ->where('name', 'like', "%$key%")
                ->orWhere('slug', 'like', "%$key%");
        }

        $datas->orderBy('created_at', $sortBy === 'latest' ? 'desc' : 'asc');

        $datas = $datas->paginate(config('myconfig.category_product_per_page'));

        if ($request->ajax()) {
            return view('admin.pages.productCategory.table', ['datas' => $datas])->render();
        }

        return view('admin.pages.productCategory.index', ['datas' => $datas]);
    }

    public function makeslug(Request $request)
    {
        $dataSlug = $request->slug;
        $slug = Str::slug($dataSlug);
        return response()->json(['slug' => $slug]);
    }


    public function destroy(ProductCategory $productCategory)
    {
        $result = $productCategory->delete();
        $message = $result ? 'Delete product category successfully' : 'Delete product category failed';
        return redirect()->route('admin.product_category.index')->with('message', $message);
    }

    public function restore(Request $request, int $id)
    {
        $data = ProductCategory::withTrashed()->find($id)->restore();
        $message = $data ? 'Restore product category successfully' : 'Restore product category failed';
        return redirect()->route('admin.product_category.index')->with('message', $message);
    }

    public function detail(ProductCategory $productCategory)
    {
        return view('admin.pages.productCategory.detail', ['data' => $productCategory]);
    }

    public function update(ProductCategoryUpdateRequest $request, int $id)
    {
        $result = ProductCategory::find($id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status
        ]);

        $message = $result ? 'Update product category successfully' : 'Update product category failed';
        return redirect()->route('admin.product_category.index')->with('message', $message);
    }
    public function forceDelete(int $id)
    {
        $productCategory = ProductCategory::withTrashed()->find($id);
        if ($productCategory) {
            $productCategory->forceDelete();
            $message = 'Product category permanently deleted';
        } else {
            $message = 'Product category not found or already deleted permanently';
        }
        return redirect()->route('admin.product_category.index')->with('message', $message);
    }
}
