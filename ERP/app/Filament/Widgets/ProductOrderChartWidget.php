<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProductOrderChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Product Order Distribution';

    protected function getData(): array
    {
        // Query to count occurrences of each product_code in the order_details table
        $productCounts = DB::table('order_details')
            ->select('product_code', DB::raw('count(*) as count'))
            ->groupBy('product_code')
            ->get();

        // Prepare the data for the chart
        $labels = [];
        $data = [];

        // Loop through the product counts and prepare chart data
        foreach ($productCounts as $product) {
            // Get product details using the product_code
            $productName = DB::table('products')
                ->where('product_code', $product->product_code)
                ->value('product_name'); // Get the product name

            $labels[] = $productName; // Product name
            $data[] = $product->count; // Count of orders for this product
        }

        return [
            'labels' => $labels, // Product names as labels
            'datasets' => [
                [
                    'label' => 'Product Order Count',
                    'data' => $data, // The number of times each product is ordered
                    'backgroundColor' => 'rgba(255, 182, 185, 0.2)',
                    'borderColor' => 'rgba(255, 182, 185, 1)',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }
}
