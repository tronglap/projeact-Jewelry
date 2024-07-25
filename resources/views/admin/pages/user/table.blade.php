<table id="tableUser" class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th style="width: 50px">#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Role</th>
            <th>Status</th>
            <th style="width: 40px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr style="text-align: center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['email'] }}</td>
                <td>{{ $data['address'] ?? 'none' }}</td>
                <td>
                    @if ($data['role'] == 1)
                        Admin
                    @elseif ($data['role'] == 2)
                        Staff
                    @elseif ($data['role'] == 0)
                        Client
                    @else
                        Unknown
                    @endif
                </td>
                <td>{{ $data['status'] ? 'Active' : 'Block' }}</td>
                <td>
                    <a href="{{ route('admin.user.detail', ['user' => $data->id]) }}" class="btn btn-success">Detail</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="card-footer clearfix">
    {{ $datas->withQueryString()->links() }}
</div>
