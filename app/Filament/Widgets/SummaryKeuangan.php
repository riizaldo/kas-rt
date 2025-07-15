<?php

namespace App\Filament\Widgets;

use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class SummaryKeuangan extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getCards(): array
    {
        $totalPemasukan = Pembayaran::sum('jumlah_bayar');
        $totalPengeluaran = Pengeluaran::sum('jumlah');
        $sisaDana = $totalPemasukan - $totalPengeluaran;

        return [
            Card::make('Total Pemasukan', number_format($totalPemasukan, 0, ',', '.'))->description('Dari seluruh pembayaran')->color('success'),
            Card::make('Total Pengeluaran', number_format($totalPengeluaran, 0, ',', '.'))->description('Pengeluaran tercatat')->color('danger'),
            Card::make('Sisa Dana', number_format($sisaDana, 0, ',', '.'))->description('Saldo saat ini')->color($sisaDana >= 0 ? 'success' : 'danger'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
