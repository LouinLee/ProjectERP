<?php

namespace App\Filament\Resources\CartDetailResource\Pages;

use App\Filament\Resources\CartDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCartDetails extends ListRecords
{
    protected static string $resource = CartDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
