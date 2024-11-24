<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Barryvdh\DomPDF\Facade\PDF;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('report')
                ->label('Print Report')
                ->icon('heroicon-o-printer')
                ->action(fn() => static::report())
                ->requiresConfirmation()
                ->modalHeading('Print All Product')
                ->modalSubheading('Are you sure you want to print the report?'),
        ];
    }

    public static function report()
    {
        $products = Product::all();

        // Load a view and pass the data to it
        $pdf = PDF::loadView('pdf.product-report', compact('products'));

        return response()->streamDownload(fn() => print($pdf->output()), 'product-report.pdf');
    }
}
