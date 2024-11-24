<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalProductStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $total = DB::table('products')->count();
        // $total = Product::count();

        return [
            Card::make('Total Product', $total)
                ->description('Current total number of products')
                ->descriptionIcon('heroicon-s-inbox')
                ->color('success'),
        ];
    }
}
