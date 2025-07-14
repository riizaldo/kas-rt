<?php

namespace App\Filament\Widgets;

use App\Helpers\StatistikHelper;
use Filament\Widgets\ChartWidget;

class StatistikPembayaranRT extends ChartWidget
{


    protected static ?string $heading = 'Statistik Pembayaran per RT';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $tahun = now()->year;

        $stat = StatistikHelper::getStatistikBulananPerRT($tahun);
        $colors = [
            ['bg' => 'rgba(255, 99, 132, 0.6)', 'border' => 'rgba(255, 99, 132, 1)'],
            ['bg' => 'rgba(54, 162, 235, 0.6)', 'border' => 'rgba(54, 162, 235, 1)'],
            ['bg' => 'rgba(255, 206, 86, 0.6)', 'border' => 'rgba(255, 206, 86, 1)'],
            ['bg' => 'rgba(75, 192, 192, 0.6)', 'border' => 'rgba(75, 192, 192, 1)'],
            ['bg' => 'rgba(153, 102, 255, 0.6)', 'border' => 'rgba(153, 102, 255, 1)'],
            ['bg' => 'rgba(255, 159, 64, 0.6)', 'border' => 'rgba(255, 159, 64, 1)'],
        ];
        return [
            'labels' => $stat['labels'],
            'datasets' => collect($stat['series'])->map(function ($row, $i) use ($colors) {
                $color = $colors[$i % count($colors)];

                return [
                    'label' => $row['rt'],
                    'data' => $row['data'],
                    'backgroundColor' => $color['bg'],
                    'borderColor' => $color['border'],
                    'borderWidth' => 1,
                ];
            })->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
