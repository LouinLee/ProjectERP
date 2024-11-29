<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartResource\Pages;
use App\Filament\Resources\CartResource\RelationManagers;
use App\Models\Cart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CartResource extends Resource
{
    protected static ?string $model = Cart::class;

    protected static ?string $navigationGroup = 'Cart';
    protected static ?string $navigationLabel = 'Cart';
    protected static ?int $navigationSort = 3; // Custom sort order (1, 2, 3, etc.)
    protected static ?string $navigationIcon = 'heroicon-s-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cart_code')
                    ->label('Cart Code')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('customer_code')
                    ->label('Customer')
                    ->relationship('customer', 'customer_name')
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->label('Date')
                    ->required(),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Created At')
                    ->disabled()
                    ->default(now()),
                Forms\Components\DateTimePicker::make('updated_at')
                    ->label('Updated At')
                    ->disabled()
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cart_code')->label('Cart Code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('customer.customer_name')->label('Customer Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('total_price')->label('Total Price')->sortable(), // We keep it here for display
                Tables\Columns\TextColumn::make('date')->label('Date')->date(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarts::route('/'),
            'create' => Pages\CreateCart::route('/create'),
            'edit' => Pages\EditCart::route('/{record}/edit'),
        ];
    }
}
