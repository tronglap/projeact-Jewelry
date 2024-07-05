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
        $checkNameIsExists = DB::table('blog_categories')->where('name', $request->name)->exists();

        if ($checkNameIsExists) {
            return redirect()->route('admin.blogCategories.create')->with('message', 'Name is exists!');
        } else {
            //fresh data
            $result = DB::table('blog_categories')->insert([
                'name' => $request->name,
                'slug' => $request->slug,
                'status' => $request->status
            ]);

            $message = $result ? 'Create Blog Category Success!' : 'Create Blog Category fail!';
            return redirect()->route('admin.blogCategories.create')->with('message', $message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $data = BlogCategories::find($id);

        // Kiểm tra xem dữ liệu có được tìm thấy không
        if (!$data) {
            return redirect()->route('admin.blogCategories.index')->with('message', 'Blog category not found');
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
                $message = 'Tên đã tồn tại, vui lòng chọn tên khác';
                return redirect()->route('admin.blogCategories.index')->with('message', $message);
            }
        }

        $result = $blogCategory->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status
        ]);

        $message = $result ? 'Cập nhật danh mục blog thành công' : 'Cập nhật danh mục blog thất bại';
        return redirect()->route('admin.blogCategories.index')->with('message', $message);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategories $blogCategory)
    {
        $result = $blogCategory->delete();
        $message = $result ? 'Delete blog category successfully' : 'Delete blog category failed';
        return redirect()->route('admin.blogCategories.index')->with('message', $message);
    }

    public function restore(int $id)
    {
        $data = BlogCategories::withTrashed()->find($id)->restore();
        $message = $data ? 'Restore blog category successfully' : 'Restore blog category failed';
        return redirect()->route('admin.blogCategories.index')->with('message', $message);
    }

    public function forceDelete(int $id)
    {
        $blogCategory = BlogCategories::withTrashed()->find($id);
        if ($blogCategory) {
            $blogCategory->forceDelete();
            $message = 'Blog category permanently deleted';
        } else {
            $message = 'Blog category not found or already deleted permanently';
        }
        return redirect()->route('admin.blogCategories.index')->with('message', $message);
    }
}
