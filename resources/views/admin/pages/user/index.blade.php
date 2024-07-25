@extends('admin.layouts.master')

@section('title')
    List User - {{ Auth::user()->name }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="h3 mb-0 text-gray-800">List User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">List User</li>
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
                                <h3 class="card-title">List User</h3>
                                <form id="searchForm" role="form" action="{{ route('admin.user.index') }}"
                                    method="GET">
                                    <div class="form-group">
                                        <label for="key">Search User</label>
                                        <input type="text" value="{{ request()->key ?? '' }}" id="searchKey"
                                            name="key" class="form-control" placeholder="Enter name User">
                                        <label for="sortBy">Sort by create at</label>
                                        <select name="sortBy" id="sortBy" class="form-control">
                                            <option value="">--Please Select--</option>
                                            <option value="latest" {{ request()->sortBy == 'latest' ? 'selected' : '' }}>
                                                Latest</option>
                                            <option value="oldest" {{ request()->sortBy == 'oldest' ? 'selected' : '' }}>
                                                Oldest</option>
                                        </select>
                                        <label for="sortByRole">Sort by Role:</label>
                                        <select name="sortByRole" id="sortByRole" class="form-control">
                                            <option value="">--Please Select--</option>
                                            <option value="1" {{ request()->sortByRole == '1' ? 'selected' : '' }}>
                                                Admin</option>
                                            <option value="2" {{ request()->sortByRole == '2' ? 'selected' : '' }}>
                                                Staff</option>
                                            <option value="0" {{ request()->sortByRole == '0' ? 'selected' : '' }}>
                                                Client</option>
                                        </select>
                                    </div>
                                </form>
                            </div>

                            <div class="card-body">
                                <div id="table-content">
                                    @include('admin.pages.user.table', ['datas' => $datas])
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
            $('#searchKey, #sortBy, #sortByRole').on('input change', function() {
                let query = $('#searchKey').val();
                let sortBy = $('#sortBy').val();
                let sortByRole = $('#sortByRole').val();
                $.ajax({
                    url: '{{ route('admin.user.index') }}',
                    type: 'GET',
                    data: {
                        key: query,
                        sortBy: sortBy,
                        sortByRole: sortByRole,
                    },
                    success: function(data) {
                        $('#table-content').html(data);
                    }
                });
            });
        });
    </script>
@endsection
