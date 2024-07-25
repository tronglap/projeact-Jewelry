@extends('admin.layouts.master')

@section('title')
    Create user
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create User Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create User Form</li>
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

                            <!-- form start -->
                            <form role="form" method="post" action="{{ route('admin.user.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" value="{{ old('name') }}" name="name"
                                            class="form-control" id="name" placeholder="Enter name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" value="{{ old('email') }}" name="email"
                                            class="form-control" id="email" placeholder="Enter email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="number" value="{{ old('phone') }}" name="phone"
                                            class="form-control" id="phone" placeholder="Enter phone">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" class="form-control" id="address">{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="text" name="dob" class="form-control" id="dob"
                                            value="{{ old('dob') }}" placeholder="Select your birthday">
                                        @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select name="role" class="form-control" id="role">
                                            <option value="">---Please Select---</option>
                                            <option {{ old('role') == '1' ? 'selected' : '' }} value="1">Admin
                                            </option>
                                            <option {{ old('role') == '2' ? 'selected' : '' }} value="2">Staff
                                            </option>
                                            <option {{ old('role') == '0' ? 'selected' : '' }} value="0">Client
                                            </option>
                                        </select>
                                        @error('role')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="">---Please Select---</option>
                                            <option {{ old('status') == '0' ? 'selected' : '' }} value="0">Block
                                            </option>
                                            <option {{ old('status') == '1' ? 'selected' : '' }} value="1">Active
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
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
    <!--Format DOB-->
    <script>
        $(document).ready(function() {
            $('#dob').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection
