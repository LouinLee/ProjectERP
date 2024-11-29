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

    @php
    // Group orders by 'order_code'
    $groupedOrders = collect($orders)->groupBy('order_code');
    @endphp

    @foreach($groupedOrders as $orderCode => $orderDetails)
    <div class="order-info">
        <h3>Order Code: {{ $orderCode }}</h3>
        <p><strong>Cart Code:</strong> {{ $orderDetails[0]->cart_code }}</p>
        <p><strong>Customer Name:</strong> {{ $orderDetails[0]->customer_name }}</p>
        <p><strong>Customer Email:</strong> {{ $orderDetails[0]->customer_email }}</p>
        <p><strong>Order Date:</strong> {{ $orderDetails[0]->order_date }}</p>
        <p><strong>Status:</strong> {{ $orderDetails[0]->order_status }}</p>
        <p><strong>Total Price:</strong> ${{ number_format($orderDetails[0]->total_price, 2) }}</p>
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
            @foreach($orderDetails as $detail)
            <tr>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->product_unit }}</td>
                <td>${{ number_format($detail->product_price, 2) }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>${{ number_format($detail->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach

</body>

</html>