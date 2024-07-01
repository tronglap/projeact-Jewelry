@extends('admin.layouts.master')


@section('title')
    Create Blog - {{ Auth::user()->name }}
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blog Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blog Form</li>
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

                            <form role="form" method="post" action="{{ route('admin.blog.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="image_url">Image</label>
                                        <input type="file" name="image_url" class="form-control" id="image_url">
                                        @error('image_url')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" value="{{ old('title') }}" name="title"
                                            class="form-control" id="title" placeholder="Enter title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" value="{{ old('slug') }}" name="slug"
                                            class="form-control" id="slug" placeholder="Enter slug">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Content</label>
                                        <textarea name="content" class="form-control" id="contentBlog">{{ old('content') }}</textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="">---Please Select---</option>
                                            <option {{ old('status') == '1' ? 'selected' : '' }} value="1">Show
                                            </option>
                                            <option {{ old('status') == '0' ? 'selected' : '' }} value="0">Hide
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="blog_category_id">Blog Category</label>
                                        <select name="blog_category_id" class="form-control" id="blog_category_id">
                                            <option value="">---Please Select---</option>
                                            @foreach ($blogCategories as $blogCategory)
                                                <option
                                                    {{ old('blog_category_id') == $blogCategory->id ? 'selected' : '' }}
                                                    value="{{ $blogCategory->id }}">{{ $blogCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('blog_category_id')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#title').on('keyup', function() {
                var name = $(this).val();
                $.ajax({
                    method: 'POST', //method of form
                    url: "{{ route('admin.blog.slug') }}", // action of form
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
            .create(document.querySelector('#contentBlog'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
