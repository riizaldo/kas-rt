<?php

namespace App\Filament\Widgets;

use App\Models\Iuran;
use App\Models\Warga;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;

class BelumBayarBulanIni extends Widget
{
    protected static string $view = 'filament.widgets.belum-bayar-bulan-ini';

    protected int $bulan;
    protected int $tahun;
    protected static ?int $maxColumns = 12;


    public function getColumnSpan(): int|string|array
    {
        return 12;
    }
    public function mount(): void
    {
        $this->bulan = now()->month;
        $this->tahun = now()->year;
    }

    public function getBelumBayarData()
    {
        $iuranBulanan = Iuran::with('kategoriIuran')
            ->whereHas(
                'kategoriIuran',
                fn($q) =>
                $q->where('frekuensi', 'bulanan')
            )
            ->get();

        $belumBayar = collect();

        foreach ($iuranBulanan as $iuran) {
            $wargaBelumBayar = Warga::with(['user', 'rt'])
                ->whereHas('user', function ($query) use ($iuran) {
                    $query->whereDoesntHave('pembayarans', function ($q) use ($iuran) {
                        $q->where('iuran_id', $iuran->id)
                            ->whereMonth('tanggal_bayar', $this->bulan)
                            ->whereYear('tanggal_bayar', $this->tahun);
                    });
                })
                ->get();

            foreach ($wargaBelumBayar as $warga) {
                $belumBayar->push([
                    'nama' => $warga->nama_lengkap,
                    'rt' => optional($warga->rt)->nama ?? '-',
                    'kategori_iuran' => $iuran->name,
                    'jumlah' => $iuran->jumlah,
                    'status' => 'Belum Bayar',
                ]);
            }
        }

        return $belumBayar;
    }

    public function render(): View
    {
        return view('filament.widgets.belum-bayar-bulan-ini', [
            'data' => $this->getBelumBayarData(),
        ]);
    }
}
