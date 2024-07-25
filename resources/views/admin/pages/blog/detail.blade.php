@extends('admin.layouts.master')


@section('title')
    {{ $data['title'] }}
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

                            <!-- form start -->
                            <div class="card-footer" style="background: transparent">
                                <a href="{{ route('admin.blog.index') }}">
                                    <button type="submit" class="btn btn-primary">Back to list</button>
                                </a>
                            </div>
                            <form role="form" method="post"
                                action="{{ route('admin.blog.update', ['blog' => $data->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <p>Created at: {{ $data['created_at'] }}</p>
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
                                        <label for="title">Title</label>
                                        <input type="text" value="{{ old('title') ?? $data['title'] }}" name="title"
                                            class="form-control" id="title" placeholder="Enter title">
                                        @error('title')
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
                                        <label for="content">Content</label>
                                        <textarea name="content" class="form-control" id="contentBlog">{{ old('content') ?? $data['content'] }}</textarea>
                                        @error('content')
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
                                        <label for="blog_category_id">Blog Category</label>
                                        <select name="blog_category_id" class="form-control" id="blog_category_id">
                                            <option value="">---Please Select---</option>
                                            @foreach ($blogCategories as $blogCategory)
                                                <option
                                                    {{ old('blog_category_id') ?? $data['blog_category_id'] == $blogCategory->id ? 'selected' : '' }}
                                                    value="{{ $blogCategory->id }}">{{ $blogCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('blog_category_id')
                                            <span class="text-danger">{{ $message }}<span>
                                                @enderror
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
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
                    url: "{{ route('admin.blog.slug') }}", // action of form
                    method: 'POST', //method of form
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
