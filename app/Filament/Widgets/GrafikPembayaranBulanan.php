<?php

namespace App\Filament\Widgets;

use App\Models\Pembayaran;
use Illuminate\Support\Carbon;
use Filament\Widgets\ChartWidget;

class GrafikPembayaranBulanan extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pembayaran per Bulan';
    protected static ?int $sort = 2;
    protected static ?int $maxColumns = 12;


    public function getColumnSpan(): int|string|array
    {
        return 12;
    }
    protected function getData(): array
    {
        $data = Pembayaran::selectRaw('MONTH(tanggal_bayar) as bulan, SUM(jumlah_bayar) as total')
            ->whereYear('tanggal_bayar', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulanLabels = collect(range(1, 12))->map(function ($m) {
            return Carbon::create()->month($m)->format('M');
        });

        $nilaiPembayaran = $bulanLabels->map(function ($label, $index) use ($data) {
            $bulan = $index + 1;
            return $data->firstWhere('bulan', $bulan)?->total ?? 0;
        });

        return [
            'datasets' => [
                [
                    'label' => 'Total Pembayaran',
                    'data' => $nilaiPembayaran->toArray(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $bulanLabels->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
