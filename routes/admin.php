<?php

use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\BlogCategory\BlogCategoriesController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\ProductCategory\ProductCategoryController;

use Illuminate\Support\Facades\Route;

Route::prefix('admin/product_category')
    ->name('admin.product_category.')
    ->middleware('check.user.admin')
    ->group(function () {
        Route::get('create',  [ProductCategoryController::class, 'create'])->name('create');
        Route::post('store',  [ProductCategoryController::class, 'store'])->name('store');
        Route::get('/',  [ProductCategoryController::class, 'index'])->name('index');
        Route::post('slug',  [ProductCategoryController::class, 'makeslug'])->name('slug');
        Route::post('destroy/{productCategory}',  [ProductCategoryController::class, 'destroy'])->name('destroy');
        Route::post('restore/{id}',  [ProductCategoryController::class, 'restore'])->name('restore');
        Route::get('detail/{productCategory}',  [ProductCategoryController::class, 'detail'])->name('detail');
        Route::post('update/{productCategory}',  [ProductCategoryController::class, 'update'])->name('update');
        Route::post('forceDelete/{id}',  [ProductCategoryController::class, 'forceDelete'])->name('forceDelete');
    });


Route::prefix('admin/product')
    ->name('admin.product.')
    ->middleware('check.user.admin')
    ->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::post('/slug', [ProductController::class, 'makeslug'])->name('slug');
        Route::get('/detail/{product}', [ProductController::class, 'detail'])->name('detail');
        Route::post('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

Route::prefix('admin')
    ->middleware('check.user.admin')
    ->name('admin.blogCategories.')
    ->group(function () {
        Route::get('blogCategories', [BlogCategoriesController::class, 'index'])->name('index');
        Route::get('blogCategories/create', [BlogCategoriesController::class, 'create'])->name('create');
        Route::post('blogCategories/store', [BlogCategoriesController::class, 'store'])->name('store');
        Route::post('blogCategories/slug', [BlogCategoriesController::class, 'makeSlug'])->name('slug');
        Route::get('blogCategories/detail/{blogCategory}', [BlogCategoriesController::class, 'detail'])->name('detail');
        Route::post('blogCategories/update/{blogCategory}', [BlogCategoriesController::class, 'update'])->name('update');
        Route::post('blogCategories/restore/{blogCategory}', [BlogCategoriesController::class, 'restore'])->name('restore');
        Route::post('blogCategories/forceDelete/{blogCategory}', [BlogCategoriesController::class, 'forceDelete'])->name('forceDelete');
        Route::post('blogCategories/destroy/{blogCategory}', [BlogCategoriesController::class, 'destroy'])->name('destroy');
    });

Route::get('admin/blog', [BlogController::class, 'index'])->name('admin.blog.index');
Route::get('admin/blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
Route::post('admin/blog/store', [BlogController::class, 'store'])->name('admin.blog.store');
Route::post('admin/blog/slug', [BlogController::class, 'makeSlug'])->name('admin.blog.slug');
Route::get('admin/blog/detail/{blog}', [BlogController::class, 'detail'])->name('admin.blog.detail');
Route::post('admin/blog/update/{blog}', [BlogController::class, 'update'])->name('admin.blog.update');
Route::delete('admin/blog/destroy/{blog}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');

Route::get('admin/order', [OrderController::class, 'index'])->name('admin.order.index');
Route::get('admin/order/detail/{order}', [OrderController::class, 'detail'])->name('admin.order.detail');
