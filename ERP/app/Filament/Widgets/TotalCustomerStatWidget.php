<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalCustomerStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $total = DB::table('customers')->count();
        // $total = Customer::count();

        return [
            Card::make('Total Customer', $total)
                ->description('Current total number of customers')
                ->descriptionIcon('heroicon-s-user-group')
                ->color('success'),
        ];
    }
}
