<?php

namespace App\Filament\Widgets;

use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Illuminate\Support\Carbon;
use Filament\Widgets\ChartWidget;

class GrafikPembayaranBulanan extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pemasukan & Pengeluaran Bulanan';
    protected static ?int $sort = 2;
    protected static ?int $maxColumns = 12;

    public function getColumnSpan(): int|string|array
    {
        return 12;
    }

    protected function getData(): array
    {
        $tahun = now()->year;

        $pembayaran = Pembayaran::selectRaw('MONTH(tanggal_bayar) as bulan, SUM(jumlah_bayar) as total')
            ->whereYear('tanggal_bayar', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $pengeluaran = Pengeluaran::selectRaw('MONTH(tanggal) as bulan, SUM(jumlah) as total')
            ->whereYear('tanggal', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulanLabels = collect(range(1, 12))->map(function ($m) {
            return Carbon::create()->month($m)->format('M');
        });

        $nilaiPembayaran = $bulanLabels->map(function ($label, $index) use ($pembayaran) {
            $bulan = $index + 1;
            return $pembayaran->firstWhere('bulan', $bulan)?->total ?? 0;
        });

        $nilaiPengeluaran = $bulanLabels->map(function ($label, $index) use ($pengeluaran) {
            $bulan = $index + 1;
            return $pengeluaran->firstWhere('bulan', $bulan)?->total ?? 0;
        });

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $nilaiPembayaran->toArray(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $nilaiPengeluaran->toArray(),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.6)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 2,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $bulanLabels->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
