<?php

namespace App\Filament\Resources\KategoriIuranResource\Pages;

use App\Filament\Resources\KategoriIuranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriIuran extends EditRecord
{
    protected static string $resource = KategoriIuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
