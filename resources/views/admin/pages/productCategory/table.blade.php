<table id="tableProductCategory" class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th style="width: 50px">#</th>
            <th>Name</th>
            {{-- <th>Slug</th> --}}
            <th style="width: 300px">Created at</th>
            <th style="width: 300px">Updated at</th>
            <th>Status</th>
            <th style="width: 40px">Action</th>
        </tr>
    </thead>
    <tbody>
        <style>

        </style>
        @foreach ($datas as $data)
            <tr style="text-align: center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                {{-- <td>{{ $data->slug }}</td> --}}
                <td>{{ $data->created_at->format('d/m/Y H:i:s') }}</td>
                <td>{{ $data->updated_at ? $data->updated_at->format('d/m/Y H:i:s') : 'none' }}</td>
                <td>{{ $data->status ? 'Show' : 'Hide' }}</td>
                <td>
                    @if ($data->trashed())
                        <form action="{{ route('admin.product_category.restore', ['id' => $data->id]) }}" method="post"
                            id="form-restore">
                            @csrf
                            <button id="btn-restore" type="submit" class="btn btn-success mb-1">Restore</button>
                        </form>
                        <form action="{{ route('admin.product_category.forceDelete', ['id' => $data->id]) }}"
                            method="post" id="form-force-delete" style="display:inline;">
                            @csrf
                            <button id="btn-force-delete" type="submit" class="btn btn-danger">Force Delete</button>
                        </form>
                    @else
                        <a href="{{ route('admin.product_category.detail', ['productCategory' => $data->id]) }}"
                            class="btn btn-success mb-1">Detail</a>
                        <form action="{{ route('admin.product_category.destroy', ['productCategory' => $data->id]) }}"
                            method="post" id="form-delete" style="display:inline;">
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
