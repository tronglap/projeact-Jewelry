@extends('admin.layouts.master')

@section('title')
    Product Category - {{ Auth::user()->name }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="h3 mb-0 text-gray-800">Product Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Category</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-12">
                                    @if (session('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    @if (session('danger'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('danger') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-header">
                                <h3 class="card-title">List product category</h3>
                                <form id="searchForm" role="form" action="{{ route('admin.product_category.index') }}"
                                    method="GET">
                                    <div class="form-group">
                                        <label for="key">Search category</label>
                                        <input type="text" value="{{ request()->key ?? '' }}" id="searchKey"
                                            name="key" class="form-control" placeholder="Enter name">

                                        <label for="sortBy">Sort by create at</label>
                                        <select name="sortBy" id="sortBy" class="form-control">
                                            <option value="">--Please Select--</option>
                                            <option value="latest" {{ request()->sortBy == 'latest' ? 'selected' : '' }}>
                                                Latest</option>
                                            <option value="oldest" {{ request()->sortBy == 'oldest' ? 'selected' : '' }}>
                                                Oldest</option>
                                        </select>
                                    </div>
                                </form>
                            </div>

                            <div class="card-body">
                                <div id="table-content">
                                    @include('admin.pages.productCategory.table', ['datas' => $datas])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#searchKey, #sortBy').on('input change', function() {
                let query = $('#searchKey').val();
                let sortBy = $('#sortBy').val();
                $.ajax({
                    url: '{{ route('admin.product_category.index') }}',
                    type: 'GET',
                    data: {
                        key: query,
                        sortBy: sortBy
                    },
                    success: function(data) {
                        $('#table-content').html(data);
                    }
                });
            });
        });
    </script>

    {{-- Soft Delete --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn-soft-delete").on("click", function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Bạn có chắc chắn muốn xóa?",
                    text: "Hành động này sẽ tạm ẩn danh mục này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#4e73df",
                    cancelButtonColor: "#e74a3b",
                    confirmButtonText: "Tôi đồng ý!",
                    cancelButtonText: "Hủy",
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formAction = $("#form-delete").attr("action");
                        var csrfToken = "{{ csrf_token() }}";

                        $.ajax({
                            url: formAction,
                            type: "POST",
                            data: {
                                _token: csrfToken,
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Xóa thành công!",
                                    text: "Danh mục này sẽ tạm thời ẩn đi.",
                                    icon: "success",
                                    confirmButtonColor: "#4e73df",
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire("Lỗi!", "Đã xảy ra lỗi.", "error");
                            },
                        });
                    }
                });
            });
        });
    </script>

    {{-- Restore Category --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn-restore").on("click", function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Bạn có chắc muốn phục hồi danh mục này?",
                    text: "Hành động này sẽ phục hồi danh mục này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#4e73df",
                    cancelButtonColor: "#e74a3b",
                    confirmButtonText: "Tôi đồng ý!",
                    cancelButtonText: "Hủy",
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formAction = $("#form-restore").attr("action");
                        var csrfToken = "{{ csrf_token() }}";

                        $.ajax({
                            url: formAction,
                            type: "POST",
                            data: {
                                _token: csrfToken,
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Phục hồi thành công!",
                                    text: "Danh mục này đã được phục hồi!",
                                    icon: "success",
                                    confirmButtonColor: "#4e73df",
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire("Cảnh báo!", "Đã xảy ra lỗi!.", "error");
                            },
                        });
                    }
                });
            });
        });
    </script>

    {{-- Force Delete --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn-force-delete").on("click", function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Bạn có chắc chắn muốn xóa vĩnh viễn danh mục này?",
                    text: "Hành động này sẽ xóa vĩnh viễn danh mục này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#4e73df",
                    cancelButtonColor: "#e74a3b",
                    confirmButtonText: "Tôi đồng ý!",
                    cancelButtonText: "Hủy",
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formAction = $("#form-force-delete").attr("action");
                        var csrfToken = "{{ csrf_token() }}";

                        $.ajax({
                            url: formAction,
                            type: "POST",
                            data: {
                                _token: csrfToken,
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: response.status === 'success' ?
                                        "Xóa thành công!" : "Cảnh báo!",
                                    text: response.message,
                                    icon: response.status,
                                    confirmButtonColor: "#4e73df",
                                }).then(() => {
                                    if (response.status === 'success') {
                                        location.reload();
                                    }
                                });
                            },
                            error: function(xhr) {
                                Swal.fire("Cảnh báo!", "Đã xảy ra lỗi!.", "error");
                            },
                        });
                    }
                });
            });
        });
    </script>
@endsection
