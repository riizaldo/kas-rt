<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Pengeluaran;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PengeluaranResource\Pages;
use App\Filament\Resources\PengeluaranResource\RelationManagers;

class PengeluaranResource extends Resource
{
    protected static ?string $model = Pengeluaran::class;

    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $navigationLabel = 'Pengeluaran';

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
                Textarea::make('keterangan'),
                TextInput::make('jumlah')->numeric()->required(),
                DatePicker::make('tanggal')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama'),
                TextColumn::make('jumlah')->money('IDR', true),
                TextColumn::make('tanggal')->date(),
            ])
            ->filters([

                Filter::make('tanggal_range')
                    ->form([
                        DatePicker::make('tanggal_from')->label('Dari Tanggal'),
                        DatePicker::make('tanggal_to')->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['tanggal_from'],
                                fn($q) =>
                                $q->whereDate('tanggal', '>=', $data['tanggal_from'])
                            )
                            ->when(
                                $data['tanggal_to'],
                                fn($q) =>
                                $q->whereDate('tanggal', '<=', $data['tanggal_to'])
                            );
                    }),
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
            'index' => Pages\ListPengeluarans::route('/'),
            'create' => Pages\CreatePengeluaran::route('/create'),
            'edit' => Pages\EditPengeluaran::route('/{record}/edit'),
        ];
    }
}
