<h2>Invoice Checkout</h2>

<p>Halo, {{ $order->user->name }}</p>

<p>
    Alamat: {{ $order->address }} <br>
    No HP: {{ $order->phone }} <br>
    Metode: {{ strtoupper($order->payment_method) }}
</p>

<hr>

<table width="100%" cellpadding="6" cellspacing="0" border="1">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td align="center">{{ $item->quantity }}</td>
                <td align="right">
                    Rp {{ number_format($item->price_at_purchase) }}
                </td>
                <td align="right">
                    Rp {{ number_format($item->price_at_purchase * $item->quantity) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3>Total: Rp {{ number_format($order->total) }}</h3>

<p>Terima kasih sudah berbelanja 🙏</p>
