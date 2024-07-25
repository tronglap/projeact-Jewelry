<?php

use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\BlogCategory\BlogCategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\ProductCategory\ProductCategoryController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route;

//Product Category
Route::prefix('admin/product_category')
    ->name('admin.product_category.')
    ->middleware('check.user.admin')
    ->group(function () {
        Route::get('/', [ProductCategoryController::class, 'index'])->name('index');
        Route::get('/create', [ProductCategoryController::class, 'create'])->name('create')->middleware('check.role.admin.staff');
        Route::post('/store', [ProductCategoryController::class, 'store'])->name('store')->middleware('check.role.admin.staff');
        Route::post('/slug', [ProductCategoryController::class, 'makeslug'])->name('slug');
        Route::get('/detail/{productCategory}', [ProductCategoryController::class, 'detail'])->name('detail');
        Route::post('/update/{productCategory}', [ProductCategoryController::class, 'update'])->name('update')->middleware('check.role.admin.staff');
        Route::post('/destroy/{productCategory}', [ProductCategoryController::class, 'destroy'])->name('destroy')->middleware('check.role.admin.staff');
        Route::post('/restore/{id}', [ProductCategoryController::class, 'restore'])->name('restore')->middleware('check.role.admin.staff');
        Route::post('/forceDelete/{id}', [ProductCategoryController::class, 'forceDelete'])->name('forceDelete')->middleware('check.role.admin.staff');
    });

//Product
Route::prefix('admin/product')
    ->name('admin.product.')
    ->middleware('check.user.admin')
    ->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create')->middleware('check.role.admin.staff');
        Route::post('/store', [ProductController::class, 'store'])->name('store')->middleware('check.role.admin.staff');
        Route::post('/slug', [ProductController::class, 'makeslug'])->name('slug');
        Route::post('/calculate-the-discount-price', [ProductController::class, 'calculateDiscountPrice'])->name('calculate.the.discount.price');
        Route::get('/detail/{product}', [ProductController::class, 'detail'])->name('detail');
        Route::post('/update/{product}', [ProductController::class, 'update'])->name('update')->middleware('check.role.admin.staff');
        Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy')->middleware('check.role.admin.staff');
    });

//Blog category
Route::prefix('admin/blogCategories')
    ->name('admin.blogCategories.')
    ->middleware('check.user.admin')
    ->group(function () {
        Route::get('/', [BlogCategoriesController::class, 'index'])->name('index');
        Route::get('/create', [BlogCategoriesController::class, 'create'])->name('create')->middleware('check.role.admin.staff');
        Route::post('/store', [BlogCategoriesController::class, 'store'])->name('store')->middleware('check.role.admin.staff');
        Route::post('/slug', [BlogCategoriesController::class, 'makeSlug'])->name('slug');
        Route::get('/detail/{blogCategory}', [BlogCategoriesController::class, 'detail'])->name('detail');
        Route::post('/update/{blogCategory}', [BlogCategoriesController::class, 'update'])->name('update')->middleware('check.role.admin.staff');
        Route::post('/restore/{blogCategory}', [BlogCategoriesController::class, 'restore'])->name('restore')->middleware('check.role.admin.staff');
        Route::post('/forceDelete/{blogCategory}', [BlogCategoriesController::class, 'forceDelete'])->name('forceDelete')->middleware('check.role.admin.staff');
        Route::post('/destroy/{blogCategory}', [BlogCategoriesController::class, 'destroy'])->name('destroy')->middleware('check.role.admin.staff');
    });

//Blog
Route::prefix('admin/blog')
    ->name('admin.blog.')
    ->middleware('check.user.admin')
    ->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/create', [BlogController::class, 'create'])->name('create')->middleware('check.role.admin.staff');
        Route::post('/store', [BlogController::class, 'store'])->name('store')->middleware('check.role.admin.staff');
        Route::post('/slug', [BlogController::class, 'makeSlug'])->name('slug');
        Route::get('/detail/{blog}', [BlogController::class, 'detail'])->name('detail');
        Route::post('/update/{blog}', [BlogController::class, 'update'])->name('update')->middleware('check.role.admin.staff');
        Route::delete('/destroy/{blog}', [BlogController::class, 'destroy'])->name('destroy')->middleware('check.role.admin.staff');
    });

//Order
Route::prefix('admin/order')
    ->name('admin.order.')
    ->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/detail/{order}', [OrderController::class, 'detail'])->name('detail');
        Route::post('/update-status/{id}', [OrderController::class, 'updateStatus'])->name('updateStatus')->middleware('check.role.admin.staff');
    });

//Admin
// Admin Dashboard
Route::get('admin', [DashboardController::class, 'index'])->name('admin.index')->middleware('check.user.admin');

//User
Route::prefix('admin/user')
    ->name('admin.user.')
    ->middleware('check.user.admin')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/detail/{user}', [UserController::class, 'detail'])->name('detail');
        Route::put('/{user}', [UserController::class, 'update'])->name('update')->middleware('check.role.admin.staff');
        Route::get('/create', [UserController::class, 'create'])->name('create')->middleware('check.role.admin.staff');
        Route::post('/store', [UserController::class, 'store'])->name('store')->middleware('check.role.admin.staff');
    });
