<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\CartDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Cart;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_code')
                    ->label('Order Code')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\Select::make('cart_code')
                    ->label('Cart Code')
                    ->relationship('cart', 'cart_code')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Automatically set the total price and customer code based on cart_code
                        $cart = Cart::where('cart_code', $state)->first();
                        if ($cart) {
                            $set('customer_code', $cart->customer_code);
                            // Calculate the total price based on cart details
                            $totalPrice = CartDetail::where('cart_code', $state)->sum('subtotal');
                            $set('total_price', $totalPrice);
                        } else {
                            $set('customer_code', null); // Reset if no cart found
                            $set('total_price', 0); // Reset total price
                        }
                    }),

                Forms\Components\TextInput::make('total_price')
                    ->label('Total Price')
                    ->disabled()
                    ->default(0),

                Forms\Components\TextInput::make('customer_code')
                    ->label('Customer Code')
                    ->disabled(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'Pending' => 'Pending',
                        'Completed' => 'Completed',
                        'Cancelled' => 'Cancelled',
                    ])
                    ->required(),

                Forms\Components\DateTimePicker::make('date')
                    ->label('Order Date')
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')->label('Order Code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('cart_code')->label('Cart Code')->sortable(),
                Tables\Columns\TextColumn::make('customer_code')->label('Customer Code')->sortable(),
                Tables\Columns\TextColumn::make('total_price')->label('Total Price')->sortable(),
                Tables\Columns\TextColumn::make('status')->label('Status')->sortable(),
                Tables\Columns\TextColumn::make('date')->label('Order Date')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
