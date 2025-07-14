<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Warga;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\WargaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WargaResource\RelationManagers;

class WargaResource extends Resource
{
    protected static ?string $model = Warga::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Akun Login')
                    ->relationship('user', 'email')
                    ->searchable()
                    ->required(),

                TextInput::make('nik')->required(),
                TextInput::make('no_kk'),
                TextInput::make('nama_lengkap')->required(),

                Select::make('rt_id')
                    ->label('RT')
                    ->relationship('rt', 'nama_rt')
                    ->searchable()
                    ->required(),

                TextInput::make('blok'),
                TextInput::make('no_rumah'),
                TextInput::make('no_hp')->tel(),
                Select::make('jenis_kelamin')->options(['L' => 'Laki-laki', 'P' => 'Perempuan']),
                DatePicker::make('tanggal_lahir'),
                TextInput::make('pekerjaan'),
                Select::make('status_perkawinan')->options(['kawin' => 'Kawin', 'belum' => 'Belum Kawin']),
                Textarea::make('alamat'),

                Toggle::make('is_aktif')->label('Status Aktif')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')->searchable(),
                TextColumn::make('nik'),
                TextColumn::make('rt.name')->label('RT'),
                TextColumn::make('blok'),
                TextColumn::make('no_rumah'),
                TextColumn::make('no_hp'),
                TextColumn::make('jenis_kelamin')->label('JK'),
                TextColumn::make('tanggal_lahir')->date(),
                IconColumn::make('is_aktif')
                    ->boolean()
                    ->label('Aktif'),
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
            'index' => Pages\ListWargas::route('/'),
            'create' => Pages\CreateWarga::route('/create'),
            'edit' => Pages\EditWarga::route('/{record}/edit'),
        ];
    }
}
