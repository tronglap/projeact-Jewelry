<?php

namespace App\Http\Controllers\Admin\ProductCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryStoreRequest;
use App\Http\Requests\ProductCategoryUpdateRequest;
use App\Models\OrderItem;
use App\Models\Product;
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
            $message = $checkNameIsExists ? 'Tên danh mục đã tồn tại!' : '';
            return redirect()->back()->with('danger', $message);
        } else {
            $result = DB::table('product_category')->insert([
                'name' => $request->name,
                'slug' => $request->slug,
                'status' => $request->status
            ]);

            $message = $result ? 'Tạo danh mục thành công!' : 'Tạo danh mục thất bại!';
            return redirect()->route('admin.product_category.create')->with('message', $message);
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
        $message = $result ? 'Xóa danh mục thành công!' : 'Xóa danh mục thất bại!';
        return redirect()->route('admin.product_category.index')->with('message', $message);
    }

    public function restore(Request $request, int $id)
    {
        $data = ProductCategory::withTrashed()->find($id)->restore();
        $message = $data ? 'Phục hồi danh mục thành công!' : 'Phục hồi danh mục thất bại!';
        return redirect()->route('admin.product_category.index')->with('message', $message);
    }

    public function detail(ProductCategory $productCategory)
    {
        return view('admin.pages.productCategory.detail', ['data' => $productCategory]);
    }

    public function update(ProductCategoryUpdateRequest $request, int $id)
    {
        $existingCategory = ProductCategory::where('name', $request->name)
            ->where('id', '<>', $id)
            ->first();

        if ($existingCategory) {
            $message = $existingCategory ? 'Tên danh mục đã tồn tại, vui lòng chọn tên khác!' : '';
            return redirect()->back()->with('danger', $message);
        } else {
            $result = ProductCategory::find($id)->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'status' => $request->status
            ]);

            $message = $result ? 'Cập nhật danh mục thành công!' : 'Cập nhật danh mục thất bại!';
            return redirect()->route('admin.product_category.index')->with('message', $message);
        }
    }

    public function forceDelete(int $id)
    {
        $productCategory = ProductCategory::withTrashed()->find($id);
        if ($productCategory) {
            $productIds = Product::where('product_category_id', $id)->pluck('id')->toArray();

            $hasOrderItems = OrderItem::whereIn('product_id', $productIds)->exists();
            if ($hasOrderItems) {
                $message = 'Không thể xóa danh mục vì có đơn hàng đang tham chiếu đến sản phẩm thuộc danh mục này!';
                return response()->json(['status' => 'error', 'message' => $message]);
            } else {
                $productCategory->forceDelete();
                $message = 'Danh mục đã bị xóa vĩnh viễn!';
                return response()->json(['status' => 'success', 'message' => $message]);
            }
        } else {
            $message = 'Không tìm thấy danh mục hoặc danh mục đã bị xóa vĩnh viễn!';
            return response()->json(['status' => 'error', 'message' => $message]);
        }
    }
}
