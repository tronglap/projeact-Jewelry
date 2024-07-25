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

    public function create()
    {
        $blogCategories = BlogCategories::all();
        return view('admin.pages.blog.create', ['blogCategories' => $blogCategories]);
    }

    public function store(BlogStoreRequest $request)
    {
        $existingBlog = Blog::where('title', $request->title)->first();
        if ($existingBlog) {
            $message = $existingBlog ? 'Bài viết với tên này đã tồn tại!' : '';
            return redirect()->back()->with('danger', $message);
        }

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

    public function update(BlogUpdateRequest $request, int $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return redirect()->route('admin.blog.index')->with('message', 'Không tìm thấy bài viết!');
        }

        $existingBlog = Blog::where('title', $request->title)->where('id', '!=', $id)->first();
        if ($existingBlog) {
            $message = $existingBlog ? 'Bài viết với tên này đã tồn tại!' : '';
            return redirect()->back()->with('danger', $message);
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

    public function makeSlug(Request $request)
    {
        $dataSlug = $request->slug;
        $slug = Str::slug($dataSlug);
        return response()->json(['slug' => $slug]);
    }

    public function detail($id)
    {
        $data = Blog::find($id);

        if (!$data) {
            return redirect()->route('admin.blog.index')->with('message', 'Không tìm thấy bài viết!');
        }

        $blogCategories = BlogCategories::all();
        return view('admin.pages.blog.detail', compact('data'), ['blogCategories' => $blogCategories]);
    }

    // public function destroy(Blog $blog)
    // {
    //     $result = $blog->delete();
    //     $message = $result ? 'Xóa bài viết thành công!' : 'Có lỗi xảy ra, vui lòng thử lại!';
    //     return redirect()->route('admin.blog.index')->with('message', $message);
    // }

    public function destroy(Blog $blog)
    {
        $result = $blog->delete();
        if ($result) {
            return response()->json(['message' => 'Xóa bài viết thành công!'], 200);
        } else {
            return response()->json(['message' => 'Có lỗi xảy ra, vui lòng thử lại!'], 500);
        }
    }
}