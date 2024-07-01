<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $itemPerPage = config('myconfig.blog_per_page', 10); // Số bài viết mỗi trang
        $currentPage = $request->input('page', 1); // Trang hiện tại, mặc định là 1
        $offset = ($currentPage - 1) * $itemPerPage;

        // Lấy danh sách bài viết có status là 'show' theo trang
        $datas = Blog::where('status', '!=', 'hide')
            ->offset($offset)
            ->limit($itemPerPage)
            ->get();

        // Lấy tổng số bài viết có status là 'show'
        $totalBlogs = Blog::where('status', '!=', 'hide')->count();

        // Lấy danh sách các danh mục blog
        $blogCategories = BlogCategories::all();

        // Đếm số lượng bài viết theo từng danh mục có status là 'show'
        $categoryBlogCounts = $this->countBlogsByCategory();

        $recentPosts = Blog::recentPosts();

        return view('client.pages.blog.list', [
            'datas' => $datas,
            'blogCategories' => $blogCategories,
            'categoryBlogCounts' => $categoryBlogCounts,
            'recentPosts' => $recentPosts,
            'totalBlogs' => $totalBlogs,
            'itemPerPage' => $itemPerPage,
            'currentPage' => $currentPage,
        ]);
    }

    private function countBlogsByCategory()
    {
        // Đếm số lượng bài viết theo từng danh mục có status là 'show'
        return Blog::where('status', '!=', 'hide')
            ->select('blog_category_id', DB::raw('count(*) as total'))
            ->groupBy('blog_category_id')
            ->pluck('total', 'blog_category_id');
    }

    public function recentPosts()
    {
        // Gọi phương thức recentPosts() từ model Blog để lấy 4 bài viết mới nhất
        $recentPosts = Blog::recentPosts();

        return view('client.pages.blog.list', ['recentPosts' => $recentPosts]);
    }

    public function detail($id)
    {
        $data = Blog::find($id);
        $blogCategory = BlogCategories::all();

        // Lấy danh sách các danh mục blog
        $blogCategories = BlogCategories::all();

        // Đếm số lượng bài viết theo từng danh mục có status là 'show'
        $categoryBlogCounts = $this->countBlogsByCategory();

        $recentPosts = Blog::recentPosts();

        if (!$data) {
            return redirect()->route('home.blog.index')->with('message', 'Blog is not found');
        }
        return view('client.pages.blog.detail', [
            'data' => $data, 'blogCategory' => $blogCategory, 'blogCategories' => $blogCategories, 'categoryBlogCounts' => $categoryBlogCounts, 'recentPosts' => $recentPosts
        ]);
    }
}