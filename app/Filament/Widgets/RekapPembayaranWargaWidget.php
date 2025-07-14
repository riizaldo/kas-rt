<?php

namespace App\Filament\Widgets;

use App\Models\Iuran;
use App\Models\Warga;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class RekapPembayaranWargaWidget extends Widget
{
    protected static string $view = 'filament.widgets.rekap-pembayaran-warga-widget';
    protected static ?int $maxColumns = 12;


    public function getColumnSpan(): int|string|array
    {
        return 12;
    }
    public function getRekapData(): array
    {
        $bulan = now()->month;
        $tahun = now()->year;

        // Ambil semua iuran bulanan
        $iurans = Iuran::whereHas(
            'kategoriIuran',
            fn($q) =>
            $q->where('frekuensi', 'bulanan')
        )->get();

        // Ambil semua warga dengan user dan rt
        $wargas = Warga::with(['user.pembayarans', 'rt'])->get();

        $rekap = [];

        foreach ($wargas as $warga) {
            $baris = [
                'nama' => $warga->nama_lengkap,
                'blok' => $warga->blok ?? '-',
                'status' => [],
                'total' => 0,
            ];

            foreach ($iurans as $iuran) {
                $jumlahBayar = $warga->user?->pembayarans()
                    ->where('iuran_id', $iuran->id)
                    ->whereMonth('tanggal_bayar', $bulan)
                    ->whereYear('tanggal_bayar', $tahun)
                    ->sum('jumlah_bayar');

                $baris['status'][$iuran->name] = $jumlahBayar > 0 ? 'v' : 'x';

                $baris['total'] += $jumlahBayar;
            }

            $rekap[] = $baris;
        }

        return [
            'wargas' => $rekap,
            'iuranNames' => $iurans->pluck('name')->toArray(),
        ];
    }

    public function render(): View
    {
        return view('filament.widgets.rekap-pembayaran-warga-widget', $this->getRekapData());
    }
}
