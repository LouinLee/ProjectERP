<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .order-info {
            margin-bottom: 20px;
        }

        .order-info p {
            margin: 2px 0;
        }
    </style>
</head>

<body>

    <h2>Order Report</h2>

    @foreach($orders as $order)
    <div class="order-info">
        <h3>Order Code: {{ $order->order_code }}</h3>
        <p><strong>Cart Code:</strong> {{ $order->cart->cart_code }}</p>
        <p><strong>Customer Name:</strong> {{ $order->customer->customer_name }}</p>
        <p><strong>Customer Email:</strong> {{ $order->customer->email }}</p>
        <p><strong>Order Date:</strong> {{ $order->date }}</p>
        <p><strong>Status:</strong> {{ $order->status }}</p>
        <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
            <tr>
                <td>{{ $detail->product->product_name }}</td>
                <td>{{ $detail->product->unit }}</td>
                <td>${{ number_format($detail->product->price, 2) }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>${{ number_format($detail->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach

</body>

</html>