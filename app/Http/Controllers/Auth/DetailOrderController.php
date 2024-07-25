<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\User;

class DetailOrderController extends Controller
{
    public function detail(int $id)
    {
        $data = Order::find($id);

        if (!$data) {
            return redirect()->route('admin.order.index')->with('message', 'Không tìm thấy đơn hàng!');
        }

        $orderPayment = OrderPayment::where('order_id', $id)->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
        $nameUser = User::all();

        return view('purchaseHistory.detail', compact('data', 'orderPayment', 'nameUser', 'orderItems'));
    }
}