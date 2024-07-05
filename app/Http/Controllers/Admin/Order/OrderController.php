<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orderPayment = OrderPayment::all();
        $nameUser = User::all();

        $key = $request->key ?? null;
        $sortBy = $request->sortBy ?? 'latest';

        $query = Order::query();

        if ($key) {
            $query->whereHas('user', function ($q) use ($key) {
                $q->where('name', 'like', "%$key%");
            });
        }

        $query->orderBy('created_at', $sortBy === 'latest' ? 'desc' : 'asc');

        $datas = $query->paginate(config('myconfig.order_per_page'));

        if ($request->ajax()) {
            return view('admin.pages.order.table', ['datas' => $datas])->render();
        }

        return view('admin.pages.order.index', ['datas' => $datas, 'orderPayment' => $orderPayment, 'nameUser' => $nameUser]);
    }

    public function detail($id)
    {
        $data = Order::find($id);

        if (!$data) {
            return redirect()->route('admin.order.index')->with('message', 'Không tìm thấy đơn hàng!');
        }

        $orderPayment = OrderPayment::where('order_id', $id)->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
        $nameUser = User::all();

        return view('admin.pages.order.detail', compact('data', 'orderPayment', 'nameUser', 'orderItems'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->route('admin.order.index')->with('message', 'Không tìm thấy đơn hàng!');
        }

        $status = $request->input('status');

        if ($order->updateStatus($status)) {
            return redirect()->route('admin.order.index', $id)->with('message', 'Trạng thái đơn hàng đã được cập nhật thành công!');
        }

        return redirect()->route('admin.order.index', $id)->with('message', 'Trạng thái không hợp lệ!');
    }
}