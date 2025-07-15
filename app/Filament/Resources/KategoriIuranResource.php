<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KategoriIuran;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KategoriIuranResource\Pages;
use App\Filament\Resources\KategoriIuranResource\RelationManagers;

class KategoriIuranResource extends Resource
{
    protected static ?string $model = KategoriIuran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'kategori Iuran';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
                Textarea::make('deskripsi'),
                TextInput::make('jumlah_default')->numeric()->required(),
                Select::make('frekuensi')
                    ->options([
                        'bulanan' => 'Bulanan',
                        'tahunan' => 'Tahunan',
                        'sekali' => 'Sekali',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->label('Nama'),
                TextColumn::make('deskripsi')->limit(30),
                TextColumn::make('jumlah_default')->money('IDR', true),
                TextColumn::make('frekuensi')->label('Frekuensi')->badge(),
                TextColumn::make('created_at')->label('Dibuat')->since(),
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
            'index' => Pages\ListKategoriIurans::route('/'),
            'create' => Pages\CreateKategoriIuran::route('/create'),
            'edit' => Pages\EditKategoriIuran::route('/{record}/edit'),
        ];
    }
}
