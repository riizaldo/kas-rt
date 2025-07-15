<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\StatOverview;
use App\Filament\Widgets\BelumBayarBulanIni;
use App\Filament\Widgets\StatistikPembayaranRT;
use App\Filament\Widgets\GrafikPembayaranBulanan;
use App\Filament\Widgets\RekapPembayaranWargaWidget;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            StatOverview::class,
            GrafikPembayaranBulanan::class,
        ];
    }


    protected function getFooterWidgets(): array
    {
        return [


            RekapPembayaranWargaWidget::class,
        ];
    }
}
