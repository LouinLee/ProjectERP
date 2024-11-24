<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationGroup = 'General';
    protected static ?string $navigationLabel = 'Product';
    protected static ?int $navigationSort = 0; // Custom sort order (1, 2, 3, etc.)
    protected static ?string $navigationIcon = 'heroicon-s-inbox';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('product_code')
                    ->label('Product Code')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('product_name')
                    ->label('Product Name')
                    ->required(),
                Forms\Components\TextInput::make('unit')
                    ->label('Unit')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->numeric()
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
                Tables\Columns\TextColumn::make('product_code')->label('Product Code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('product_name')->label('Product Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('unit')->label('Unit')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('price')->label('Price')->sortable(),
                Tables\Columns\TextColumn::make('quantity')->label('Quantity')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Action::make('importExcel')
                    ->label('Import Excel')
                    ->action(function (array $data) {
                        // Pastikan $data['file'] adalah jalur yang valid di storage
                        $filePath = storage_path('app/public/' . $data['file']); // Import file menggunakan jalur absolut
                        Excel::import(new ProductImport, $filePath); // Tampilkan notifikasi sukses 
                        Notification::make()
                            ->title('Import Data Successful!')
                            ->success()
                            ->send();
                    })
                    ->form([
                        FileUpload::make('file')->label('Select Excel File')->disk('public') // Pastikan disimpan di disk 'public' 
                            ->directory('imports')->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])->required(),
                    ])->modalHeading('Import Product Data')->modalButton('Import')->color('success'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
