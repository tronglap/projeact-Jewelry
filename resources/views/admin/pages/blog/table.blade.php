<table id="tableBlog" class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th style="width: 50px">#</th>
            <th style="width:350px">Title</th>
            {{-- <th>Slug</th> --}}
            <th style="width:400px">Content</th>
            <th>Blog Category</th>
            <th>Status</th>
            <th style="width: 40px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr style="text-align: center">
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: left">{{ $data->title }}</td>
                {{-- <td>{{ $data->slug }}</td> --}}
                <td
                    style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;overflow: hidden; text-align: left; ">
                    {!! $data->content !!}</td>
                <td>{{ $data->BlogCategories->name }}</td>
                <td>{{ $data->status ? 'Show' : 'Hide' }}</td>
                <td>
                    <a href="{{ route('admin.blog.detail', ['blog' => $data->id]) }}"
                        class="btn btn-success mb-1">Detail</a>
                    <form id="form-delete" action="{{ route('admin.blog.destroy', ['blog' => $data->id]) }}"
                        method="post">
                        @method('DELETE')
                        @csrf
                        <button id="btn-delete" type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="card-footer clearfix">
    {{ $datas->withQueryString()->links() }}
</div>
