<table class="table table-bordered">
    <thead style="text-align: center">
        <th>#</th>
        <th>ID</th>
        <th>Created</th>
        <th>Total</th>
        <th>Status</th>
        <th>Payment method</th>
        <th>Actor</th>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr style="text-align: center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                <td>${{ number_format($order->total, 2) }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    @if ($order->orderPaymentMethods->isNotEmpty())
                        @foreach ($order->orderPaymentMethods as $paymentMethod)
                            {{ $paymentMethod->payment_method }}
                        @endforeach
                    @endif
                </td>
                <td>
                    <a href="{{ route('detail', ['id' => $order->id]) }}">
                        <x-primary-button>Detail</x-primary-button>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
