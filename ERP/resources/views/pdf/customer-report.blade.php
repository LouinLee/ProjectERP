<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Report</title>
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

    <h2>Customer Report</h2>

    <!-- Customer Details Table -->
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Total Orders</th>
                <th>Total Revenue</th>
                <th>Last Order Date</th>
                <th>Most Bought Product</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->customer_name }}</td>
                <td>{{ $customer->orders->count() }}</td>
                <td>${{ number_format($customer->orders->sum('total_price'), 2) }}</td>
                <td>
                    @php
                    $lastOrderDate = $customer->orders->isNotEmpty()
                    ? \Carbon\Carbon::parse($customer->orders->max('date'))->format('F d, Y')
                    : 'N/A';
                    @endphp
                    {{ $lastOrderDate }}
                </td>
                <td>
                    @php
                    // Get the products sorted by the total quantity bought for each customer
                    $mostBoughtProduct = $customer->orders->flatMap(function($order) {
                    return $order->orderDetails;
                    })->groupBy('product_code')->map(function ($details) {
                    return $details->sum('quantity');
                    })->sortDesc()->keys()->first();

                    // If there is a most bought product, get its name, otherwise, return 'N/A'
                    $mostBoughtProductName = $mostBoughtProduct
                    ? $customer->orders->flatMap(function($order) use ($mostBoughtProduct) {
                    return $order->orderDetails->where('product_code', $mostBoughtProduct);
                    })->first()->product->product_name
                    : 'N/A';
                    @endphp
                    {{ $mostBoughtProductName }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Generated on: {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
        <p>Thank you for your business!</p>
    </div>

</body>

</html>