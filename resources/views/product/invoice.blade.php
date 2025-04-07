<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ public_path('css/invoice.css') }}">
</head>
<body>

    <div class="invoice-header">
        <h2>Invoice</h2>
        <p><strong>To:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->phone }}</p>
        <p><strong>Address:</strong> {{ $user->address }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->selected_price, 2) }}</td>
                <td>{{ $product->selected_qty }}</td>
                <td>{{ number_format($product->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right" style="margin-top: 20px;">
        <strong>Subtotal:</strong> {{ number_format($subtotal, 2) }}
    </div>

    <div class="thank-you">
        Thank you for your purchase!
    </div>

</body>
</html>
