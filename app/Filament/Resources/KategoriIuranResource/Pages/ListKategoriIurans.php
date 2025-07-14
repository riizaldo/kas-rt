<?php

namespace App\Filament\Resources\KategoriIuranResource\Pages;

use App\Filament\Resources\KategoriIuranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriIurans extends ListRecords
{
    protected static string $resource = KategoriIuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
