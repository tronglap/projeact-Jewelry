<table id="tableBlogCategories" class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">Number</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Created at</th>
            <th>Status</th>
            <th style="width: 40px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->slug }}</td>
                <td>{{ $data->created_at->format('d/m/Y') }}</td>
                <td>{{ $data->status ? 'Show' : 'Hide' }}</td>
                <td>
                    @if ($data->trashed())
                        <form action="{{ route('admin.blogCategories.restore', ['blogCategory' => $data->id]) }}"
                            method="post">
                            @csrf
                            <button onclick="return confirm('Are you sure?')" type="submit"
                                class="btn btn-success">Restore</button>
                        </form>
                        <form action="{{ route('admin.blogCategories.forceDelete', ['blogCategory' => $data->id]) }}"
                            method="post" style="display:inline;">
                            @csrf
                            <button onclick="return confirm('Are you sure you want to permanently delete this item?')"
                                type="submit" class="btn btn-danger">Force Delete</button>
                        </form>
                    @else
                        <a href="{{ route('admin.blogCategories.detail', ['blogCategory' => $data->id]) }}"
                            class="btn btn-success">Detail</a>
                        <form action="{{ route('admin.blogCategories.destroy', ['blogCategory' => $data->id]) }}"
                            method="post" style="display:inline;">
                            @csrf
                            <button onclick="return confirm('Are you sure?')" type="submit"
                                class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="card-footer clearfix">
    {{ $datas->withQueryString()->links() }}
</div>
