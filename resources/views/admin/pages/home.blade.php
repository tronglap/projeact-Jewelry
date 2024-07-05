@extends('admin.layouts.master')
@section('title')
    Admin
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    @if (session('message'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    @endif

    <!-- Content Row -->
    <div class="row">
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Status Order Deliver</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="order-status-container" class="chart-pie pt-4 pb-2">
                        <canvas id="orderStatusChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small" id="order-status-legend">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Product Category Summary</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="productCategorySummaryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Total revenue per month</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="totalRevenuePerMonth" data-labels='{!! $labels !!}'
                            data-revenue='{!! $revenueData !!}'></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var orderStatusData = {!! json_encode($data) !!};
        var productCategoryData = {!! json_encode($dataCategory) !!};
    </script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/admin/orderStatusChart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/admin/productCategorySummary.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/admin/totalRevenueChart.js') }}"></script>
@endsection
