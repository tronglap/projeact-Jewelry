<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        $datas = Order::all();
        $orderPayment = OrderPayment::all();
        $nameUser = User::all();

        $key = $request->key ?? null;
        $sortBy = $request->sortBy ?? 'latest';

        $query = Order::query();

        if ($key) {
            $query->where('name', 'like', "%$key%");
        }

        $query->orderBy('created_at', $sortBy === 'latest' ? 'desc' : 'asc');

        $datas = $query->paginate(config('myconfig.order_per_page'));

        if ($request->ajax()) {
            return view('admin.pages.order.table', ['datas' => $datas])->render();
        }

        return view('admin.pages.order.index', ['datas' => $datas, 'orderPayment' => $orderPayment, 'nameUser' => $nameUser]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function detail($id)
    {
        $data = Order::find($id);

        if (!$data) {
            return redirect()->route('admin.order.index')->with('message', 'Order not found');
        }

        $orderPayment = OrderPayment::all();
        $nameUser = User::all();

        return view('admin.pages.order.detail', compact('data'), ['orderPayment' => $orderPayment, 'nameUser' => $nameUser]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
