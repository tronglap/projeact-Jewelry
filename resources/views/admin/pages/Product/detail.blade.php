@extends('admin.layouts.master')


@section('title')
    {{ $data['name'] }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Form</li>
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
                            <div class="card-footer" style="background: transparent">
                                <a href="{{ route('admin.product.index') }}">
                                    <button type="submit" class="btn btn-primary">Back to list</button>
                                </a>
                            </div>
                            <!-- form start -->
                            <form role="form" method="post"
                                action="{{ route('admin.product.update', ['product' => $data->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <p>Created at: {{ $data['created_at'] }}</p>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" value="{{ old('name') ?? $data['name'] }}" name="name"
                                            class="form-control" id="name" placeholder="Enter name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" value="{{ old('slug') ?? $data['slug'] }}" name="slug"
                                            class="form-control" id="slug" placeholder="Enter slug">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" value="{{ old('price') ?? $data['price'] }}" name="price"
                                            class="form-control" id="price" placeholder="Enter Price">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="sale">Sale</label>
                                        <input type="checkbox" name="sale" value="1" id="sale"
                                            {{ old('sale') ?? $data['sale'] == '1' ? 'checked' : '' }}>
                                        @error('sale')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div id="promotion-field" style="display: none;">
                                            <div class="form-group">
                                                <label for="salePercent">Sale Percent (%)</label>
                                                <input type="number" name="salePercent"
                                                    value="{{ old('salePercent') ?? number_format((($data['price'] - $data['promotion']) / $data['price']) * 100, 0) }}"
                                                    class="form-control" id="salePercent">
                                                @error('salePercent')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="promotion">Promotion</label>
                                                <input type="number" class="form-control" name="promotion" id="promotion"
                                                    value="{{ old('promotion') ?? $data['promotion'] }}" readonly>
                                                @error('promotion')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" value="{{ old('quantity') ?? $data['quantity'] }}"
                                            name="quantity" class="form-control" id="quantity"
                                            placeholder="Enter quantity">
                                        @error('quantity')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image_url">Image</label>
                                        <input type="file" name="image_url" class="form-control" id="image_url">
                                        @if (!empty($data->image_url))
                                            <div>
                                                <img src="{{ asset('assets/images/' . $data->image_url) }}"
                                                    alt="Current Image" style="max-width: 100px; max-height: 100px;">
                                            </div>
                                        @endif
                                        @error('image_url')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image_url_second">Image second</label>
                                        <input type="file" name="image_url_second" class="form-control"
                                            id="image_url_second">
                                        @if (!empty($data->image_url_second))
                                            <div>
                                                <img src="{{ asset('assets/images_second/' . $data->image_url_second) }}"
                                                    alt="Current Image" style="max-width: 100px; max-height: 100px;">
                                            </div>
                                        @endif
                                        @error('image_url_second')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="shortDescription">Short description</label>
                                        <textarea name="shortDescription" class="form-control" id="shortDescription">{{ old('shortDescription') ?? $data['shortDescription'] }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" id="description">{{ old('description') ?? $data['description'] }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="">---Please Select---</option>
                                            <option {{ old('status') ?? $data['status'] == '1' ? 'selected' : '' }}
                                                value="1">Show
                                            </option>
                                            <option {{ old('status') ?? $data['status'] == '0' ? 'selected' : '' }}
                                                value="0">Hide
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_category_id">Product Category</label>
                                        <select name="product_category_id" class="form-control" id="product_category_id">
                                            <option value="">---Please Select---</option>
                                            @foreach ($productCategories as $productCategory)
                                                <option
                                                    {{ old('product_category_id') ?? $data['product_category_id'] == $productCategory->id ? 'selected' : '' }}
                                                    value="{{ $productCategory->id }}">{{ $productCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_category_id')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                var name = $(this).val();

                $.ajax({
                    method: 'POST', //method of form
                    url: "{{ route('admin.product.slug') }}", // action of form
                    data: {
                        slug: name,
                        _token: '{{ csrf_token() }}'
                    }, //input name
                    success: function(result) {
                        $('#slug').val(result.slug);
                    }
                })
            })
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#shortDescription'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        $(document).ready(function() {
            // Check the initial state of the checkbox
            if ($('#sale').is(':checked')) {
                $('#promotion-field').show();
            }

            // Event listener for checkbox change
            $('#sale').change(function() {
                if (this.checked) {
                    $('#promotion-field').slideDown();
                } else {
                    $('#promotion-field').slideUp();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#salePercent').on('input', function() {
                var price = $('#price').val();
                var salePercent = $(this).val();

                if (price && salePercent) {
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('admin.product.calculate.the.discount.price') }}",
                        data: {
                            price: price,
                            salePercent: salePercent,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            $('#promotion').val(result.discountPrice);
                        }
                    });
                }
            });
        });
    </script>
@endsection
