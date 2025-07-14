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

        $wargas = Warga::with(['user.pembayarans', 'rt'])->get();

        foreach ($iuranBulanan as $iuran) {
            foreach ($wargas as $warga) {
                // Cek apakah warga belum membayar iuran ini di bulan & tahun sekarang
                $sudahBayar = $warga->user?->pembayarans()
                    ->where('iuran_id', $iuran->id)
                    ->whereMonth('tanggal_bayar', $this->bulan)
                    ->whereYear('tanggal_bayar', $this->tahun)
                    ->exists();

                if (! $sudahBayar) {
                    $belumBayar->push([
                        'nama' => $warga->nama_lengkap,
                        'blok' => $warga->blok ?? '-',
                        'kategori_iuran' => $iuran->name,
                        'jumlah' => $iuran->jumlah, // ini default target jumlah, bukan yang dibayar
                        'status' => 'Belum Bayar',
                    ]);
                }
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
