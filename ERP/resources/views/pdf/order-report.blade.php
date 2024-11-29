<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 30px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 26px;
            margin-bottom: 20px;
        }

        .order-info {
            margin-bottom: 30px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .order-info h3 {
            margin-bottom: 10px;
            font-size: 20px;
            color: #34495e;
        }

        .order-info p {
            margin: 4px 0;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
        }

        .order-info p strong {
            width: 30%;
            text-align: left;
        }

        .order-info p span {
            width: 65%;
            text-align: left;
            padding-left: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
            font-size: 14px;
        }

        td {
            font-size: 14px;
            color: #555;
        }

        .subtotal-row {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .total-revenue {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            padding-top: 20px;
            padding-right: 20px;
            color: #2c3e50;
            margin-top: 40px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #aaa;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <h2>Order Report</h2>

    <!-- Total Revenue at the Top -->
    <div class="total-revenue">
        @php
        $totalRevenue = $orders->sum('total_price');
        @endphp
        <p><strong>Total Revenue: ${{ number_format($totalRevenue, 2) }}</strong></p>
    </div>

    @foreach($orders as $order)
    <div class="order-info">
        <h3>Order Code: {{ $order->order_code }}</h3>
        <div>
            <p><strong>Cart Code:</strong><span>{{ $order->cart->cart_code }}</span></p>
            <p><strong>Customer Name:</strong><span>{{ $order->customer->customer_name }}</span></p>
            <p><strong>Customer Email:</strong><span>{{ $order->customer->email }}</span></p>
            <p><strong>Order Date:</strong><span>{{ $order->date }}</span></p>
            <p><strong>Status:</strong><span>{{ $order->status }}</span></p>
        </div>
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
            <tr class="subtotal-row">
                <td colspan="4" style="text-align: right;"><strong>Order Total:</strong></td>
                <td><strong>${{ number_format($order->total_price, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>
    @endforeach

    <!-- Footer -->
    <div class="footer">
        <p>Generated on: {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
        <p>Thank you for your business!</p>
    </div>

</body>

</html>