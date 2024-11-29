<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Barryvdh\DomPDF\Facade\PDF;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('report')
                ->label('Print Report')
                ->icon('heroicon-o-printer')
                ->action(fn() => static::report())
                ->requiresConfirmation()
                ->modalHeading('Print All Customer')
                ->modalSubheading('Are you sure you want to print the report?'),
        ];
    }

    public static function report()
    {
        // Load all customers with their related orders, order details, product
        $customers = Customer::with('orders.orderDetails.product')->get();

        // Load the view and pass the customers data to it
        $pdf = PDF::loadView('pdf.customer-report', compact('customers'));

        return response()->streamDownload(fn() => print($pdf->output()), 'customer-report.pdf');
    }
}
