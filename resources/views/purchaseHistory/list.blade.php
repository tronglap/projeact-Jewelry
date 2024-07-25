<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('VIEW PURCHUSE HISTORY') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <ul class="nav nav-tabs position-tab" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pending-tab" data-bs-toggle="tab"
                            data-bs-target="#pending-tab-pane" type="button" role="tab"
                            aria-controls="pending-tab-pane" aria-selected="true">PENDING</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="delivered-tab" data-bs-toggle="tab"
                            data-bs-target="#delivered-tab-pane" type="button" role="tab"
                            aria-controls="delivered-tab-pane" aria-selected="false">DELIVERED</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="shipping-tab" data-bs-toggle="tab"
                            data-bs-target="#shipping-tab-pane" type="button" role="tab"
                            aria-controls="shipping-tab-pane" aria-selected="false">SHIPPING</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                            data-bs-target="#completed-tab-pane" type="button" role="tab"
                            aria-controls="completed-tab-pane" aria-selected="false">COMPLETED</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="canceled-tab" data-bs-toggle="tab"
                            data-bs-target="#canceled-tab-pane" type="button" role="tab"
                            aria-controls="canceled-tab-pane" aria-selected="false">CANCELED</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="refunded-tab" data-bs-toggle="tab"
                            data-bs-target="#refunded-tab-pane" type="button" role="tab"
                            aria-controls="refunded-tab-pane" aria-selected="false">REFUNDED</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pending-tab-pane" role="tabpanel"
                        aria-labelledby="pending-tab" tabindex="0">
                        @include('purchaseHistory.partials.table', ['orders' => $pendingOrders])
                    </div>
                    <div class="tab-pane fade" id="delivered-tab-pane" role="tabpanel" aria-labelledby="delivered-tab"
                        tabindex="0">
                        @include('purchaseHistory.partials.table', ['orders' => $deliveredOrders])
                    </div>
                    <div class="tab-pane fade" id="shipping-tab-pane" role="tabpanel" aria-labelledby="shipping-tab"
                        tabindex="0">
                        @include('purchaseHistory.partials.table', ['orders' => $shippingOrders])
                    </div>
                    <div class="tab-pane fade" id="completed-tab-pane" role="tabpanel" aria-labelledby="completed-tab"
                        tabindex="0">
                        @include('purchaseHistory.partials.table', ['orders' => $completedOrders])
                    </div>
                    <div class="tab-pane fade" id="canceled-tab-pane" role="tabpanel" aria-labelledby="canceled-tab"
                        tabindex="0">
                        @include('purchaseHistory.partials.table', ['orders' => $canceledOrders])
                    </div>
                    <div class="tab-pane fade" id="refunded-tab-pane" role="tabpanel" aria-labelledby="refunded-tab"
                        tabindex="0">
                        @include('purchaseHistory.partials.table', ['orders' => $refundedOrders])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
