<?php

namespace App\Filament\Widgets;

use App\Models\RT;
use App\Models\Iuran;
use App\Models\Warga;
use App\Models\Pembayaran;
use App\Models\KategoriIuran;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Warga Aktif', Warga::where('is_aktif', true)->count())
                ->description('Terdaftar di sistem')
                ->color('success'),

            Stat::make('Jumlah RT', RT::count())
                ->description('Wilayah RT aktif'),

            Stat::make('Kategori Iuran', KategoriIuran::count())
                ->description('Jenis iuran'),

            Stat::make('Iuran Bulan Ini', Iuran::whereMonth('tanggal_mulai', now()->month)->count())
                ->description('Periode berjalan')
                ->color('warning'),

            Stat::make(
                'Pembayaran Bulan Ini',
                'Rp ' . number_format(
                    Pembayaran::whereMonth('tanggal_bayar', now()->month)->sum('jumlah_bayar'),
                    0,
                    ',',
                    '.'
                )
            )->description('Total masuk')
                ->color('info'),
        ];
    }
}
