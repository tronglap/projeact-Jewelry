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
    /**
     * Display a listing of the resource.
     */
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        return view('admin.pages.Product.create', ['productCategories' => $productCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
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

            //move_uploaded_file()
            $file->move(public_path('assets/images/'), $fileName);
        }

        $product->image_url = $fileName;

        if ($request->hasFile('image_url_second')) {
            $file = $request->file('image_url_second');
            $originName = $file->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = $fileName . '_' . uniqid() . '.' . $extension;

            //move_uploaded_file()
            $file->move(public_path('assets/images_second/'), $fileName);
        }

        $product->image_url_second = $fileName;
        $product->save(); // insert

        $message = $product ? 'Thêm sản phẩm thành công!' : 'Thêm sản phẩm thất bại!';
        return redirect()->route('admin.product.create')->with('message', $message);
    }

    public function update(ProductUpdateRequest $request, int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.product.index')->with('message', 'Không tìm thấy sản phẩm!');
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

        $message = $product ? 'Cập nhật thông tim sản phẩm thành công!' : 'Cập nhật thông tim sản phẩm thất bại!';
        return redirect()->route('admin.product.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $result = $product->delete();
        $message = $result ? 'Xóa sản phẩm thành công!' : 'Xóa sản phẩm thất bại!';
        return redirect()->route('admin.product.index')->with('message', $message);
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
}