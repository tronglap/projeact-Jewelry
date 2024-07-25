<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Đếm số lượng đơn hàng theo trạng thái
        $orderStatusCounts = Order::select('status', DB::raw('count(*) as total'))
            ->whereNotIn('id', function ($query) {
                $query->select('order_id')
                    ->from('order_item')
                    ->join('product', 'order_item.product_id', '=', 'product.id')
                    ->where('product.status', 'hide');
            })
            ->groupBy('status')
            ->get();

        $data = [['Order Status', 'Number']];
        foreach ($orderStatusCounts as $item) {
            $data[] = [ucfirst($item->status), $item->total];
        }

        // Đếm số lượng sản phẩm theo danh mục
        $productCategoryCounts = Product::join('product_category', 'product.product_category_id', '=', 'product_category.id')
            ->select('product_category.name', DB::raw('count(*) as total'))
            ->where('product_category.status', '!=', 'hide')
            ->groupBy('product_category.id')
            ->orderBy('total', 'desc')
            ->get();

        $dataCategory = [['Product Category Name', 'Total Product']];
        foreach ($productCategoryCounts as $item) {
            $dataCategory[] = [$item->name, $item->total];
        }

        // Tính tổng doanh thu của tháng hiện tại
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $totalRevenueCurrentMonth = Order::where('status', 'COMPLETED')
            ->whereNotIn('id', function ($query) {
                $query->select('order_id')
                    ->from('order_item')
                    ->join('product', 'order_item.product_id', '=', 'product.id')
                    ->where('product.status', 'hide');
            })
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('total');

        // Tính tổng doanh thu của các tháng trong năm hiện tại
        $monthlyRevenues = Order::select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as total'))
            ->where('status', 'COMPLETED')
            ->whereNotIn(
                'id',
                function ($query) {
                    $query->select('order_id')
                        ->from('order_item')
                        ->join('product', 'order_item.product_id', '=', 'product.id')
                        ->where('product.status', 'hide');
                }
            )
            ->whereYear('created_at', $currentYear)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $labels = $monthlyRevenues->map(function ($item) {
            return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
        });

        $revenueData = $monthlyRevenues->pluck('total');

        // Lấy 5 sản phẩm có lượt bán cao nhất
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        $topProductDetails = [];
        foreach ($topProducts as $product) {
            $productDetails = Product::select('name')
                ->where('id', $product->product_id)
                ->first();
            $topProductDetails[] = [
                'name' => $productDetails->name,
                'total_quantity' => $product->total_quantity,
            ];
        }

        // Lấy 10 sản phẩm có số lượng cao nhất
        $topProductsByQuantity = Product::select('name', 'quantity')
            ->orderByDesc('quantity')
            ->limit(10)
            ->get();

        // Tổng doanh thu hàng năm
        $annualRevenue = $monthlyRevenues->sum('total');

        // Thống kê phương thức thanh toán có status là success
        $popularPaymentMethods = OrderPayment::select('payment_method', DB::raw('count(*) as total'))
            ->where('status', 'success')
            ->groupBy('payment_method')
            ->orderByDesc('total')
            ->get();

        return view('admin.pages.home', [
            'data' => $data,
            'dataCategory' => $dataCategory,
            'labels' => $labels->toJson(),
            'revenueData' => $revenueData->toJson(),
            'topProductDetails' => $topProductDetails,
            'topProductsByQuantity' => $topProductsByQuantity,
            'totalRevenueCurrentMonth' => $totalRevenueCurrentMonth,
            'annualRevenue' => $annualRevenue,
            'popularPaymentMethods' => $popularPaymentMethods
        ]);
    }
}