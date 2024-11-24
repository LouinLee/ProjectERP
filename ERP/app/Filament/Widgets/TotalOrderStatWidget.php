<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalOrderStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $total = DB::table('orders')->count();
        // $total = Order::count();

        return [
            Card::make('Total Order', $total)
                ->description('Current total number of orders')
                ->descriptionIcon('heroicon-s-shopping-bag')
                ->color('success'),
        ];
    }
}
