<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Report</title>
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

    <h2>Product Report</h2>

    <!-- Total Revenue -->
    <div class="total-revenue">
        @php
        $totalRevenue = 0;
        $totalUnitsSold = 0;
        foreach($products as $product) {
        $unitsSold = $product->orderDetails->sum('quantity');
        $totalRevenue += $unitsSold * $product->price;
        $totalUnitsSold += $unitsSold;
        }
        @endphp
        <p><strong>Total Revenue: ${{ number_format($totalRevenue, 2) }}</strong></p>
    </div>

    <!-- Product Details Table -->
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Stock</th>
                <th>Units Sold</th>
                <th>Quantity Added to Cart</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            @php
            $unitsSold = $product->orderDetails->sum('quantity');
            $revenue = $unitsSold * $product->price;

            // Calculate the quantity added to cart
            $quantityAddedToCart = $product->cartDetails->sum('quantity');
            @endphp
            <tr>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $unitsSold }}</td>
                <td>{{ $quantityAddedToCart }}</td>
                <td>${{ number_format($revenue, 2) }}</td>
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