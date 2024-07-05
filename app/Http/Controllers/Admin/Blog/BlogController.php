<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\BlogCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $key = $request->key ?? null;
        $sortBy = $request->sortBy ?? 'latest';

        $query = Blog::query();

        if ($key) {
            $query->where('title', 'like', "%$key%")
                ->orWhere('slug', 'like', "%$key%");
        }

        $query->orderBy('created_at', $sortBy === 'latest' ? 'desc' : 'asc');

        $datas = $query->paginate(config('myconfig.blog_per_page'));

        if ($request->ajax()) {
            return view('admin.pages.blog.table', ['datas' => $datas])->render();
        }

        return view('admin.pages.blog.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogCategories = BlogCategories::all();
        return view('admin.pages.blog.create', ['blogCategories' => $blogCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request)
    {
        $blog = new Blog();
        $blog->title = $request['title'];
        $blog->slug = $request['slug'];
        $blog->content = $request['content'];
        $blog->status = $request['status'];
        $blog->blog_category_id = $request['blog_category_id'];

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $originName = $file->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = $fileName . '_' . uniqid() . '.' . $extension;

            //move_uploaded_file()
            $file->move(public_path('assets/images/'), $fileName);
        }

        $blog->image_url = $fileName;

        $blog->save(); // insert

        $message = $blog ? 'Đăng bài thành công!' : 'Có lỗi xảy ra, vui lòng thử lại!';
        return redirect()->route('admin.blog.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function update(BlogUpdateRequest $request, int $id)
    {
        $blog = blog::find($id);

        if (!$blog) {
            return redirect()->route('admin.blog.index')->with('message', 'Không tìm thấy bài viết!');
        }

        $blog->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'content' => $request['content'],
            'status' => $request['status'],
            'blog_category_id' => $request['blog_category_id']
        ]);

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $originName = $file->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = $fileName . '_' . uniqid() . '.' . $extension;

            //move_uploaded_file()
            $file->move(public_path('assets/images/'), $fileName);
            $blog->image_url = $fileName;
        }


        $blog->save(); // insert

        $message = $blog ? 'Cập nhật bài viết thành công!' : 'Có lỗi xảy ra, vui lòng thử lại!';
        return redirect()->route('admin.blog.index')->with('message', $message);
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
    public function detail($id)
    {
        $data = Blog::find($id);

        if (!$data) {
            return redirect()->route('admin.blog.index')->with('message', 'Không tìm thấy bài viết!');
        }

        $blogCategories = BlogCategories::all();
        return view('admin.pages.blog.detail', compact('data'), ['blogCategories' => $blogCategories]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $result = $blog->delete();
        $message = $result ? 'Xóa bài viết thành công!' : 'Có lỗi xảy ra, vui lòng thử lại!';
        return redirect()->route('admin.blog.index')->with('message', $message);
    }
}