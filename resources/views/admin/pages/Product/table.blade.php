<table id="tableProduct" class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Promotion</th>
            <th>Quantity</th>
            {{-- <th>Description</th> --}}
            <th>Product Category</th>
            {{-- <th>Slug</th> --}}
            <th>Status</th>
            <th style="width: 40px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr style="text-align: center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>$ {{ number_format($data->price, 2, '.', ',') }}</td>
                <td>
                    {{ $data->promotion ? '$' . number_format($data->promotion, 2, '.', ',') : 'None' }}
                    @if ($data->promotion > 0)
                        Sale:{{ number_format((($data->price - $data->promotion) / $data->price) * 100, 2, '.', ',') }}%
                    @else
                    @endif
                </td>

                <td>{{ $data->quantity }}</td>
                {{-- <td
                    style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;overflow: hidden; text-align: left">
                    {!! $data->description !!}
                </td> --}}
                <td>{{ $data->ProductCategory->name }}</td>
                {{-- <td>{{ $data->slug }}</td> --}}
                <td>{{ $data->status ? 'Show' : 'Hide' }}</td>
                <td>
                    <a href="{{ route('admin.product.detail', ['product' => $data->id]) }}"
                        class="btn btn-success">Detail</a>
                    <form action="{{ route('admin.product.destroy', ['product' => $data->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button onclick="return confirm('Are you sure')" type="submit"
                            class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="card-footer clearfix">
    {{ $datas->withQueryString()->links() }}
</div>
