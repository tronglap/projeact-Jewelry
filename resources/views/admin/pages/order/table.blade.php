<table id="tableOrder" class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th style="width: 50px">#</th>
            <th>Name</th>
            <th>Address</th>
            <th>Status</th>
            <th>Create at</th>
            <th>Update at</th>
            <th style="width: 40px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr style="text-align: center">
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td>{{ $data['id'] }}</td>
                <td>{{ $data->User->name }}</td>
                <td>{{ $data['address'] }}</td>
                <td>{{ $data['status'] }}</td>
                <td>{{ $data['created_at']->format('d/m/Y H:i:s') }}</td>
                <td>{{ $data['updated_at']->format('d/m/Y H:i:s') }}</td>
                <td>
                    <a href="{{ route('admin.order.detail', ['order' => $data->id]) }}" class="btn btn-success">Detail</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="card-footer clearfix">
    {{ $datas->withQueryString()->links() }}
</div>
