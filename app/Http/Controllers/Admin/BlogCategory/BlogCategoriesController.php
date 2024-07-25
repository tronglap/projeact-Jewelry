<?php

namespace App\Http\Controllers\Admin\BlogCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoriesStoreRequest;
use App\Http\Requests\BlogCategoriesUpdateRequest;
use App\Models\BlogCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class BlogCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $key = $request->key ?? null;
        $sortBy = $request->sortBy ?? 'latest';

        if (is_null($key)) {
            $datas = BlogCategories::withTrashed();
        } else {
            $datas = BlogCategories::withTrashed()
                ->where('name', 'like', "%$key%")
                ->orWhere('slug', 'like', "%$key%");
        }

        $datas->orderBy('created_at', $sortBy === 'latest' ? 'desc' : 'asc');

        $datas = $datas->paginate(config('myconfig.category_blog_per_page'));

        if ($request->ajax()) {
            return view('admin.pages.blogCategory.table', ['datas' => $datas])->render();
        }
        return view('admin.pages.blogCategory.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.blogCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoriesStoreRequest $request)
    {
        $checkNameIsExists = BlogCategories::where('name', $request->name)->exists();

        if ($checkNameIsExists) {
            $message = $checkNameIsExists ? 'Danh mục đã tồn tại!' : '';
            return redirect()->back()->with('danger', $message);
        } else {
            //fresh data
            $result = DB::table('blog_categories')->insert([
                'name' => $request->name,
                'slug' => $request->slug,
                'status' => $request->status
            ]);

            $message = $result ? 'Tạo danh mục thành công!' : 'Tạo danh mục thất bại!';
            return redirect()->route('admin.blogCategories.create')->with('message', $message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $data = BlogCategories::find($id);

        if (!$data) {
            return redirect()->route('admin.blogCategories.index')->with('message', 'Không tìm thấy danh mục!');
        }

        return view('admin.pages.blogCategory.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function makeSlug(Request $request)
    {
        $dataSlug = $request->slug;
        $slug = Str::slug($dataSlug);
        return response()->json(['slug' => $slug]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoriesUpdateRequest $request, int $id)
    {
        $blogCategory = BlogCategories::find($id);

        if ($request->name !== $blogCategory->name) {
            $existingCategory = BlogCategories::where('name', $request->name)
                ->where('id', '!=', $id)
                ->first();

            if ($existingCategory) {
                $message = $existingCategory ? 'Tên đã tồn tại, vui lòng chọn tên khác!' : '';
                return redirect()->back()->with('danger', $message);
            }
        }

        $result = $blogCategory->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status
        ]);

        $message = $result ? 'Cập nhật danh mục thành công!' : 'Cập nhật danh mục thất bại!';
        return redirect()->route('admin.blogCategories.index')->with('message', $message);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategories $blogCategory)
    {
        $result = $blogCategory->delete();
        $message = $result ? 'Xóa danh mục thành công!' : 'Xóa danh mục thất bại!';
        return redirect()->route('admin.blogCategories.index')->with('message', $message);
    }

    public function restore(int $id)
    {
        $data = BlogCategories::withTrashed()->find($id)->restore();
        $message = $data ? 'Phục hồi danh mục thành công!' : 'Phục hồi danh mục thất bại!';
        return redirect()->route('admin.blogCategories.index')->with('message', $message);
    }

    public function forceDelete(int $id)
    {
        $blogCategory = BlogCategories::withTrashed()->find($id);
        if ($blogCategory) {
            $blogCategory->forceDelete();
            $message = 'Danh mục đã bị xóa vĩnh viễn!';
        } else {
            $message = 'Không tìm thấy danh mục hoặc danh mục đã bị xóa vĩnh viễn!';
        }
        return redirect()->route('admin.blogCategories.index')->with('message', $message);
    }
}