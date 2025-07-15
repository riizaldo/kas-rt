<?php

namespace App\Filament\Widgets;

use App\Models\RT;
use App\Models\Iuran;
use App\Models\Warga;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\KategoriIuran;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatOverview extends BaseWidget
{

    protected function getColumns(): int
    {
        return 2; // 4 stat item, otomatis 3 kolom per item
    }
    protected function getStats(): array
    {

        $pemasukan = Pembayaran::whereMonth('tanggal_bayar', now()->month)->sum('jumlah_bayar');
        $pengeluaran = Pengeluaran::whereMonth('tanggal', now()->month)->sum('jumlah');
        $sisaDana = $pemasukan - $pengeluaran;

        $pemasukan_all = Pembayaran::sum('jumlah_bayar');
        $pengeluaran_all = Pengeluaran::sum('jumlah');
        $sisaDana_all = $pemasukan_all - $pengeluaran_all;

        return [
            Stat::make(
                'Sisa Dana Sampai Saat ini',
                'Rp ' . number_format(
                    $sisaDana_all,
                    0,
                    ',',
                    '.'
                )
            )->description('Saldo saat ini')
                ->color('info'),
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
            Stat::make(
                'Pengeluaran Bulan Ini',
                'Rp ' . number_format(
                    Pengeluaran::whereMonth('tanggal', now()->month)->sum('jumlah'),
                    0,
                    ',',
                    '.'
                )
            )->description('Total masuk')
                ->color('warning'),


            Stat::make(
                'Sisa Dana Bulan Ini',
                'Rp ' . number_format($sisaDana, 0, ',', '.')
            )->description('Saldo bulan ini')
                ->color($sisaDana >= 0 ? 'success' : 'danger'),

        ];
    }
}
