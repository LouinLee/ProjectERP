<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderDetailResource\Pages;
use App\Models\OrderDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderDetailResource extends Resource
{
    protected static ?string $model = OrderDetail::class;

    protected static ?string $navigationGroup = 'Order';
    protected static ?string $navigationLabel = 'Order Detail';
    protected static ?int $navigationSort = 6; // Custom sort order (1, 2, 3, etc.)
    protected static ?string $navigationIcon = 'heroicon-s-list-bullet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('orderdetail_code')
                    ->label('Order Detail Code')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabled(),

                Forms\Components\Select::make('order_code')
                    ->label('Order Code')
                    ->relationship('order', 'order_code')
                    ->disabled(),

                Forms\Components\Select::make('product_code')
                    ->label('Product')
                    ->relationship('product', 'product_name')
                    ->disabled(),

                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->disabled(),

                Forms\Components\TextInput::make('subtotal')
                    ->label('Subtotal')
                    ->disabled()
                    ->dehydrateStateUsing(fn($state) => number_format($state, 2)), // Format for display
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('orderdetail_code')->label('Order Detail Code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('order_code')->label('Order Code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('product_code')->label('Product Code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('quantity')->label('Quantity')->sortable(),
                Tables\Columns\TextColumn::make('subtotal')->label('Subtotal')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderDetails::route('/'),
            // Remove create and edit routes since they're not needed
        ];
    }
}
