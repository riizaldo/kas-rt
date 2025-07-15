<?php

namespace App\Filament\Resources;

use App\Models\RT;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RTResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RTResource\RelationManagers;

class RTResource extends Resource
{
    protected static ?string $model = RT::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationGroup = 'Data Penduduk';
    protected static ?string $navigationLabel = 'RT';
    public static function getNavigationLabel(): string
    {
        return 'RT'; // Ganti dari 'RT' ke 'Blok'
    }

    public static function getModelLabel(): string
    {
        return 'RT';
    }

    public static function getPluralModelLabel(): string
    {
        return 'RT';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_rt')
                    ->label('Nama RT')
                    ->required()
                    ->maxLength(10),

                Textarea::make('keterangan')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('RT')->searchable(),
                TextColumn::make('keterangan')->limit(30),
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
            'index' => Pages\ListRTS::route('/'),
            'create' => Pages\CreateRT::route('/create'),
            'edit' => Pages\EditRT::route('/{record}/edit'),
        ];
    }
}
