<table id="tableBlogCategories" class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th style="width: 50px">#</th>
            <th>Name</th>
            {{-- <th>Slug</th> --}}
            <th>Created at</th>
            <th>Updated at</th>
            <th>Status</th>
            <th style="width: 40px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr style="text-align: center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                {{-- <td>{{ $data->slug }}</td> --}}
                <td>{{ $data->created_at->format('d/m/Y') }}</td>
                <td>{{ $data->updated_at ? $data->updated_at->format('d/m/Y') : 'none' }}</td>
                <td>{{ $data->status ? 'Show' : 'Hide' }}</td>
                <td>
                    @if ($data->trashed())
                        <form id="form-restore"
                            action="{{ route('admin.blogCategories.restore', ['blogCategory' => $data->id]) }}"
                            method="post">
                            @csrf
                            <button id="btn-restore" type="submit" class="btn btn-success mb-1">Restore</button>
                        </form>
                        <form id="form-force-delete"
                            action="{{ route('admin.blogCategories.forceDelete', ['blogCategory' => $data->id]) }}"
                            method="post" style="display:inline;">
                            @csrf
                            <button id="btn-force-delete" type="submit" class="btn btn-danger">Force Delete</button>
                        </form>
                    @else
                        <a href="{{ route('admin.blogCategories.detail', ['blogCategory' => $data->id]) }}"
                            class="btn btn-success mb-1">Detail</a>
                        <form id="form-delete"
                            action="{{ route('admin.blogCategories.destroy', ['blogCategory' => $data->id]) }}"
                            method="post" style="display:inline;">
                            @csrf
                            <button id="btn-soft-delete" type="submit" class="btn btn-danger">Delete</button>
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
