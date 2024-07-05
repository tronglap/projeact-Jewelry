<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // SELECT status, count(*) as total FROM `order` GROUP BY status;
        $result = DB::table('order')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $data = [['Order Status', 'Number']];
        foreach ($result as $item) {
            $data[] = [ucfirst($item->status), $item->total];
        }

        // SELECT product_category.name, count(*) as total
        // FROM `product`
        // INNER JOIN product_category ON product.product_category_id = product_category.id
        // GROUP BY product.product_category_id;
        $resultCategory = DB::table('product')
            ->select('product_category.name', DB::raw('count(*) as total'))
            ->join('product_category', 'product_category.id', '=', 'product.product_category_id')
            ->groupBy('product_category_id')
            ->orderBy('total', 'desc')
            ->get();

        $dataCategory = [['Product Category Name', 'Total Product']];
        foreach ($resultCategory as $item) {
            $dataCategory[] = [$item->name, $item->total];
        }

        $resultRevenue = DB::table('order')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total) as total'))
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
            ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
            ->get();

        $labels = [];
        $revenueData = [];
        foreach ($resultRevenue as $item) {
            $labels[] = $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
            $revenueData[] = (float) $item->total;
        }

        return view('admin.pages.home', [
            'data' => $data,
            'dataCategory' => $dataCategory,
            'labels' => json_encode($labels),
            'revenueData' => json_encode($revenueData)
        ]);
    }
}
