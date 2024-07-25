@extends('admin.layouts.master')

@section('title')
    Order of {{ $data['id'] }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Order Detail</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            @if (session('message'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- Content start -->
                            <div class="card-footer">
                                <a href="{{ route('admin.order.index') }}">
                                    <button type="submit" class="btn btn-primary">Back to list</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-7">
                                                <div class="card mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div
                                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                        <h6 class="m-0 font-weight-bold text-primary">Information
                                                            customer</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        <p>Customer: {{ $data->User->name }}</p>
                                                        <p>Address: {{ $data->address }}</p>
                                                        <p>Email: {{ $data->User->email }}</p>
                                                        <p>Phone: {{ $data->User->phone }}</p>
                                                        <p>Note: {{ $data->note ?? 'Nothing' }}</p>
                                                        <p>Total: ${{ number_format($data->total, 2) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-7">
                                                <div class="card mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div
                                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                        <h6 class="m-0 font-weight-bold text-primary">Order Items</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        <table id="tableOrderItems" class="table table-bordered">
                                                            <thead>
                                                                <tr style="text-align: center;">
                                                                    <th style="width: 50px">#</th>
                                                                    <th>Name</th>
                                                                    <th>Price</th>
                                                                    <th>Promotion</th>
                                                                    <th>Quantity</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($orderItems as $item)
                                                                    <tr style="text-align: center;">
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $item->name }}</td>
                                                                        <td>${{ number_format($item->price, 2, '.', ',') }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $item->promotion ? '$' . number_format($item->promotion, 2, '.', ',') : 'None' }}
                                                                        </td>
                                                                        <td>{{ $item->quantity }}</td>
                                                                        <td>
                                                                            ${{ $item->promotion ? number_format($item->promotion * $item->quantity, 2, '.', ',') : number_format($item->price * $item->quantity, 2, '.', ',') }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-7">
                                                <div class="card mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div
                                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                        <h6 class="m-0 font-weight-bold text-primary">Order Actions</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        <p>Payment method: {{ $orderPayment->payment_method }}
                                                        </p>
                                                        <p>Order date: {{ $data->created_at->format('d/m/Y H:i:s') }}
                                                        </p>
                                                        <p>Updated by: {{ $data->updater->name }} </p>
                                                        @if (count($data->getNextStatuses()) > 0)
                                                            <form
                                                                action="{{ route('admin.order.updateStatus', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <p>Current order status: {{ $data->status }}</p>
                                                                <div class="form-group">
                                                                    <label for="status">Update Status:</label>
                                                                    <select name="status" id="status"
                                                                        class="form-control">
                                                                        @foreach ($data->getNextStatuses() as $status)
                                                                            <option value="{{ $status }}"
                                                                                {{ $data->status == $status ? 'selected' : '' }}>
                                                                                {{ ucfirst(strtolower($status)) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <button type="submit" class="btn btn-success">Update
                                                                    Status</button>
                                                            </form>
                                                        @else
                                                            <p>Status order: {{ ucfirst(strtolower($data->status)) }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
@endsection
