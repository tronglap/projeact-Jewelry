<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('DETAIL ORDER') }}
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="btn-back">
                    <a href="{{ route('history') }}">
                        <x-primary-button class="d-flex gap-2 justify-between mb-2"> <i class="fa-solid fa-angle-left"
                                style="color: #ffffff;"></i>
                            BACK TO LIST</x-primary-button>
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
                                            <h6 class="m-0 font-weight-bold text-black uppercase">Information
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
                                            <h6 class="m-0 font-weight-bold text-black uppercase">Order Items</h6>
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
                                            <h6 class="m-0 font-weight-bold text-black uppercase">Order Actions</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <p>Payment method: {{ $orderPayment->payment_method }}
                                            </p>
                                            <p>Order date: {{ $data->created_at->format('d/m/Y H:i:s') }}
                                            </p>
                                            <p>Status order: {{ ucfirst(strtolower($data->status)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
