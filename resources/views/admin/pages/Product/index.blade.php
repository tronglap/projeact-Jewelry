@extends('admin.layouts.master')


@section('title')
    List Product - {{ Auth::user()->name }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @if (session('message'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="card-header">
                                <h3 class="card-title">List Product</h3>
                                <form id="searchForm" role="form" action="{{ route('admin.product.index') }}"
                                    method="GET">
                                    <div class="form-group">
                                        <label for="key">Search product</label>
                                        <input type="text" value="{{ request()->key ?? '' }}" id="searchKey"
                                            name="key" class="form-control" placeholder="Enter name product">
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
                                    @include('admin.pages.Product.table', ['datas' => $datas])
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
    <script>
        $(document).ready(function() {
            $('#searchKey, #sortBy').on('input change', function() {
                let query = $('#searchKey').val();
                let sortBy = $('#sortBy').val();
                $.ajax({
                    url: '{{ route('admin.product.index') }}',
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
@endsection
