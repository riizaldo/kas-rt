<?php

namespace App\Filament\Resources;

use App\Models\RT;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pembayaran;
use Filament\Tables\Table;
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
use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use App\Models\Warga;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'user',
                'user.warga.rt',
                'iuran.kategoriIuran'
            ]);
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Warga (User)')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Select::make('iuran_id')
                    ->label('Iuran')
                    ->relationship('iuran', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('jumlah_bayar')->numeric()->required(),
                DatePicker::make('tanggal_bayar')->required(),
                Textarea::make('keterangan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Warga'),
                TextColumn::make('user.warga.blok')->label('Blok'),
                TextColumn::make('iuran.name')->label('Iuran'),
                TextColumn::make('jumlah_bayar')->money('IDR', true),
                TextColumn::make('tanggal_bayar')->date(),
                TextColumn::make('keterangan')->limit(30),
            ])
            ->filters([


                SelectFilter::make('user')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->label('Warga'),
                // ✅ Filter berdasarkan Kategori Iuran langsung dari iuran.kategoriIuran
                SelectFilter::make('iuran.kategoriIuran')
                    ->label('Kategori Iuran')
                    ->relationship('iuran.kategoriIuran', 'nama')
                    ->searchable(),

                // ✅ Filter Bulan & Tahun dengan Form
                Filter::make('tanggal_bayar')
                    ->form([
                        Select::make('bulan')
                            ->label('Bulan')
                            ->options(array_combine(range(1, 12), [
                                'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember'
                            ])),
                        Select::make('tahun')
                            ->label('Tahun')
                            ->options(
                                collect(range(now()->year - 5, now()->year))
                                    ->reverse()
                                    ->mapWithKeys(fn($y) => [$y => $y])
                            ),
                    ])

                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['bulan'] ?? null,
                                fn($q, $bulan) =>
                                $q->whereMonth('tanggal_bayar', $bulan)
                            )
                            ->when(
                                $data['tahun'] ?? null,
                                fn($q, $tahun) =>
                                $q->whereYear('tanggal_bayar', $tahun)
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
