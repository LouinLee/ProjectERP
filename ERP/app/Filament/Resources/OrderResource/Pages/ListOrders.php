<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('report')
                ->label('Print Report')
                ->icon('heroicon-o-printer')
                ->action(fn() => static::report())
                ->requiresConfirmation()
                ->modalHeading('Print All Order')
                ->modalSubheading('Are you sure you want to print the report?'),
        ];
    }

    // SQL Query - LOL...
    public function report()
    {
        // Execute raw SQL query to fetch order data with joins
        $orders = DB::select("
            SELECT
                orders.order_code,
                orders.cart_code,
                orders.date AS order_date,
                orders.status AS order_status,
                orders.total_price,
                customers.customer_name,
                customers.email AS customer_email,
                order_details.product_code,
                order_details.quantity,
                order_details.subtotal AS order_subtotal,
                products.product_name,
                products.unit AS product_unit,
                products.price AS product_price
            FROM orders
            INNER JOIN order_details ON orders.order_code = order_details.order_code
            INNER JOIN products ON order_details.product_code = products.product_code
            INNER JOIN customers ON orders.customer_code = customers.customer_code
        ");

        // Pass the data to the view
        $pdf = PDF::loadView('pdf.order-report-query', compact('orders'));

        return response()->streamDownload(fn() => print($pdf->output()), 'order-report.pdf');
    }

    // // Eloquent Relationship
    // public function report()
    // {
    //     // Fetching orders with their related order details, customer, and product information
    //     $orders = Order::with(['orderDetails.product', 'customer', 'cart'])
    //         ->get();  // You can add a where condition to filter orders by date, customer, etc.

    //     // Load a view and pass the data to it
    //     $pdf = PDF::loadView('pdf.order-report', compact('orders'));


    //     return response()->streamDownload(fn() => print($pdf->output()), 'order-report.pdf');
    // }
}
