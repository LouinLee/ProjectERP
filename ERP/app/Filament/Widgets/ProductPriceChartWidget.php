<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProductPriceChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Price Comparison Chart';

    protected function getData(): array
    {
        // Fetch only the top 8 products by price (you can adjust the order by clause as needed)
        // $products = Product::orderBy('price', 'desc')->take(8)->get();

        $products = DB::table('products')
            ->select('product_name', 'price')
            ->orderBy('product_code', 'asc')
            ->take(8)
            ->get();

        // Prepare data for the chart
        $labels = [];
        $prices = [];

        foreach ($products as $product) {
            $labels[] = $product->product_name; // Set product name as the label
            $prices[] = (float) $product->price; // Set price as the value (ensure it's a float)
        }

        return [
            'labels' => $labels, // Labels for each bar (product names)
            'datasets' => [
                [
                    'label' => 'Product Price', // Dataset label
                    'data' => $prices, // Price data
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)', // Light green bars
                    'borderColor' => 'rgba(75, 192, 192, 1)', // Darker green border for bars
                    'borderWidth' => 1, // Border width
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
