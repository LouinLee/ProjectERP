<?php

namespace App\Filament\Widgets;

use App\Models\OrderDetail;
use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProductOrderChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Product Order Distribution';

    protected function getData(): array
    {
        // Get the total quantity for each product in the order_details table
        $productCounts = OrderDetail::select('product_code', DB::raw('sum(quantity) as total_quantity'))
            ->groupBy('product_code')
            ->get();

        // Prepare the data for the chart
        $labels = [];
        $data = [];

        // Loop through the product counts and prepare chart data
        foreach ($productCounts as $productCount) {
            // Get the related product using the product relationship
            $productName = $productCount->product->product_name; // Access the product name
            $labels[] = $productName; // Product name

            $data[] = $productCount->total_quantity; // Sum of quantities for this product
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
