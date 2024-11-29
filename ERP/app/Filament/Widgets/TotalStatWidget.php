<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Get total customer count
        $totalCustomer = DB::table('customers')->count();

        // Get total order count
        $totalOrder = DB::table('orders')->count();

        // Get total product count
        $totalProduct = DB::table('products')->count();

        return [
            // Total Customer Card
            Card::make('Total Customer', $totalCustomer)
                ->description('Current total number of customers')
                ->descriptionIcon('heroicon-s-user-group')
                ->color('success'),

            // Total Order Card
            Card::make('Total Order', $totalOrder)
                ->description('Current total number of orders')
                ->descriptionIcon('heroicon-s-shopping-bag')
                ->color('success'),

            // Total Product Card
            Card::make('Total Product', $totalProduct)
                ->description('Current total number of products')
                ->descriptionIcon('heroicon-s-inbox')
                ->color('success'),
        ];
    }
}
