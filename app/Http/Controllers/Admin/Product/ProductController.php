<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->key ?? null;
        $sortBy = $request->sortBy ?? 'latest';

        $query = Product::query();

        if ($key) {
            $query->where('name', 'like', "%$key%")
                ->orWhere('slug', 'like', "%$key%");
        }

        $query->orderBy('created_at', $sortBy === 'latest' ? 'desc' : 'asc');

        $datas = $query->paginate(config('myconfig.product_per_page'));

        if ($request->ajax()) {
            return view('admin.pages.Product.table', ['datas' => $datas])->render();
        }

        return view('admin.pages.Product.index', ['datas' => $datas]);
    }

    public function create()
    {
        $productCategories = ProductCategory::all();
        return view('admin.pages.Product.create', ['productCategories' => $productCategories]);
    }

    public function store(ProductStoreRequest $request)
    {
        $existingProduct = Product::where('name', $request->name)->first();
        if ($existingProduct) {
            return redirect()->route('admin.product.create')->with('danger', 'Sản phẩm với tên này đã tồn tại!');
        }

        $product = new Product();
        $product->name = $request['name'];
        $product->slug = $request['slug'];
        $product->price = $request['price'];
        $product->sale = $request['sale'];
        $product->promotion = $request['promotion'];
        $product->quantity = $request['quantity'];
        $product->description = $request['description'];
        $product->shortDescription = $request['shortDescription'];
        $product->status = $request['status'];
        $product->product_category_id = $request['product_category_id'];

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $originName = $file->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = $fileName . '_' . uniqid() . '.' . $extension;

            $file->move(public_path('assets/images/'), $fileName);
            $product->image_url = $fileName;
        }

        if ($request->hasFile('image_url_second')) {
            $file = $request->file('image_url_second');
            $originName = $file->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = $fileName . '_' . uniqid() . '.' . $extension;

            $file->move(public_path('assets/images_second/'), $fileName);
            $product->image_url_second = $fileName;
        }

        $product->save();

        $message = $product ? 'Thêm sản phẩm thành công!' : 'Thêm sản phẩm thất bại!';
        return redirect()->route('admin.product.create')->with('message', $message);
    }

    public function update(ProductUpdateRequest $request, int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.product.index')->with('message', 'Không tìm thấy sản phẩm!');
        }

        $existingProduct = Product::where('name', $request->name)->where('id', '!=', $id)->first();
        if ($existingProduct) {
            return redirect()->back()->with('danger', 'Sản phẩm với tên này đã tồn tại!');
        }

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'sale' => $request->sale,
            'promotion' => $request->promotion,
            'quantity' => $request->quantity,
            'shortDescription' => $request->shortDescription,
            'description' => $request->description,
            'status' => $request->status,
            'product_category_id' => $request->product_category_id
        ]);

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $originName = $file->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = $fileName . '_' . uniqid() . '.' . $extension;

            $file->move(public_path('assets/images/'), $fileName);
            $product->image_url = $fileName;
        }

        if ($request->hasFile('image_url_second')) {
            $file = $request->file('image_url_second');
            $originName = $file->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = $fileName . '_' . uniqid() . '.' . $extension;

            $file->move(public_path('assets/images_second/'), $fileName);
            $product->image_url_second = $fileName;
        }

        $product->save();

        $message = $product ? 'Cập nhật thông tin sản phẩm thành công!' : 'Cập nhật thông tin sản phẩm thất bại!';
        return redirect()->route('admin.product.index')->with('message', $message);
    }

    public function destroy(Product $product)
    {
        if ($product->orderItems()->count() > 0) {
            return redirect()->back()->with('danger', 'Không thể xóa sản phẩm vì có đơn hàng liên quan.');
        }

        $result = $product->delete();
        $message = $result ? 'Xóa sản phẩm thành công!' : 'Xóa sản phẩm thất bại!';
        return response()->json(['message' => $message], $result ? 200 : 500);
    }

    public function detail(Product $product)
    {
        $productCategories = ProductCategory::all();
        return view('admin.pages.product.detail', ['data' => $product, 'productCategories' => $productCategories]);
    }

    public function makeslug(Request $request)
    {
        $dataSlug = $request->slug;
        $slug = Str::slug($dataSlug);
        return response()->json(['slug' => $slug]);
    }

    public function calculateDiscountPrice(Request $request)
    {
        $price = $request->price;
        $salePercent = $request->salePercent;

        $discountPrice = $price - ($price * ($salePercent / 100));

        return response()->json(['discountPrice' => $discountPrice]);
    }
}
