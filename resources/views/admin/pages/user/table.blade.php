<table id="tableUser" class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">Number</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Role</th>
            <th style="width: 40px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
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
