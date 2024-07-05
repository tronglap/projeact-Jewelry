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
        $itemPerPage = config('myconfig.blog_per_page', 10);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $itemPerPage;

        $datas = Blog::where('status', '!=', 'hide')
            ->offset($offset)
            ->limit($itemPerPage)
            ->get();

        $totalBlogs = Blog::where('status', '!=', 'hide')->count();

        $blogCategories = BlogCategories::all();

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
        return Blog::where('status', '!=', 'hide')
            ->select('blog_category_id', DB::raw('count(*) as total'))
            ->groupBy('blog_category_id')
            ->pluck('total', 'blog_category_id');
    }

    public function recentPosts()
    {
        $recentPosts = Blog::where('status', '!=', 'hide')
            ->recentPosts();

        return view('client.pages.blog.list', ['recentPosts' => $recentPosts]);
    }


    public function detail($id)
    {
        $data = Blog::find($id);
        $blogCategory = BlogCategories::all();

        $blogCategories = BlogCategories::all();

        $categoryBlogCounts = $this->countBlogsByCategory();

        $recentPosts = Blog::recentPosts();

        if (!$data || $data->status === 'hide') {
            return redirect()->route('home.blog.index')->with('message', 'Blog is not found');
        }
        return view('client.pages.blog.detail', [
            'data' => $data, 'blogCategory' => $blogCategory, 'blogCategories' => $blogCategories, 'categoryBlogCounts' => $categoryBlogCounts, 'recentPosts' => $recentPosts
        ]);
    }
}
