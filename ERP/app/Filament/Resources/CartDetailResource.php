<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartDetailResource\Pages;
use App\Models\CartDetail;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CartDetailResource extends Resource
{
    protected static ?string $model = CartDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cartdetail_code')
                    ->label('Cart Detail Code')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\Select::make('cart_code')
                    ->label('Cart Code')
                    ->relationship('cart', 'cart_code')
                    ->required(),

                Forms\Components\Select::make('product_code')
                    ->label('Product')
                    ->options(Product::all()->pluck('product_name', 'product_code'))
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $productPrice = Product::where('product_code', $state)->value('price');
                        // Update subtotal if product price is found
                        if ($productPrice !== null) {
                            $set('subtotal', $productPrice); // Set initial subtotal based on product price
                        }
                    }),

                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        $productCode = $get('product_code');
                        $productPrice = Product::where('product_code', $productCode)->value('price');

                        // Calculate subtotal
                        if ($productPrice !== null) {
                            $set('subtotal', $productPrice * $state);
                        }
                    }),

                Forms\Components\TextInput::make('subtotal')
                    ->label('Subtotal')
                    ->disabled()
                    ->default(0)
                    ->dehydrateStateUsing(fn($state) => number_format($state, 2)),

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
                Tables\Columns\TextColumn::make('cartdetail_code')->label('Cart Detail Code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('cart_code')->label('Cart Code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('product_code')->label('Product Code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('quantity')->label('Quantity')->sortable(),
                Tables\Columns\TextColumn::make('subtotal')->label('Subtotal')->sortable(),
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
            'index' => Pages\ListCartDetails::route('/'),
            'create' => Pages\CreateCartDetail::route('/create'),
            'edit' => Pages\EditCartDetail::route('/{record}/edit'),
        ];
    }
}
