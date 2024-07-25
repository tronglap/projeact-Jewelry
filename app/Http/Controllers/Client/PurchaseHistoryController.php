<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $orders = $user->orders()->whereHas('orderPaymentMethods', function ($query) {
            $query->where('status', '!=', 'fail');
        })->with('orderPaymentMethods')->get();

        $pendingOrders = $orders->where('status', 'PENDING');
        $deliveredOrders = $orders->where('status', 'DELIVERED');
        $shippingOrders = $orders->where('status', 'SHIPPING');
        $completedOrders = $orders->where('status', 'COMPLETED');
        $canceledOrders = $orders->where('status', 'CANCELED');
        $refundedOrders = $orders->where('status', 'REFUNDED');

        // Truyền người dùng và đơn hàng vào view
        return view('purchaseHistory.list', [
            'user' => $user,
            'pendingOrders' => $pendingOrders,
            'deliveredOrders' => $deliveredOrders,
            'shippingOrders' => $shippingOrders,
            'completedOrders' => $completedOrders,
            'canceledOrders' => $canceledOrders,
            'refundedOrders' => $refundedOrders,
        ]);
    }
}