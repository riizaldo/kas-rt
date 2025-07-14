<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Iuran;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\IuranResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\IuranResource\RelationManagers;

class IuranResource extends Resource
{
    protected static ?string $model = Iuran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('kategoriIuran');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kategori_iuran_id')
                    ->label('Kategori Iuran')
                    ->relationship('kategoriIuran', 'nama')
                    ->searchable()
                    ->required(),

                TextInput::make('name')->required(),
                TextInput::make('jumlah')->numeric()->required(),
                DatePicker::make('tanggal_mulai')->required(),
                DatePicker::make('tanggal_selesai')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('kategoriIuran.nama')->label('Kategori'),
                TextColumn::make('jumlah')->money('IDR', true),
                TextColumn::make('tanggal_mulai')->date(),
                TextColumn::make('tanggal_selesai')->date(),
                BadgeColumn::make('kategoriIuran.frekuensi')->label('Frekuensi'),
            ])
            ->filters([
                SelectFilter::make('kategori_iuran_id')
                    ->label('Kategori Iuran')
                    ->relationship('kategoriIuran', 'nama'),


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
            'index' => Pages\ListIurans::route('/'),
            'create' => Pages\CreateIuran::route('/create'),
            'edit' => Pages\EditIuran::route('/{record}/edit'),
        ];
    }
}
