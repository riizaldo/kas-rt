<?php

namespace App\Helpers;

use App\Models\RT;
use Illuminate\Support\Carbon;

class StatistikHelper
{
    public static function getStatistikBulananPerRT(int $tahun): array
    {
        $bulanLabels = collect(range(1, 12))->map(
            fn($bulan) =>
            Carbon::create()->month($bulan)->format('M')
        )->toArray();

        $rts = RT::with('wargas.user.pembayarans')->get();

        $result = [];

        foreach ($rts as $rt) {
            $data = array_fill(0, 12, 0);

            foreach ($rt->wargas as $warga) {
                $user = $warga->user;
                if (!$user) continue;

                foreach ($user->pembayarans as $bayar) {
                    $tgl = \Carbon\Carbon::parse($bayar->tanggal_bayar);
                    if ($tgl->year == $tahun) {
                        $bulanIndex = $tgl->month - 1;
                        $data[$bulanIndex] += $bayar->jumlah_bayar;
                    }
                }
            }

            $result[] = [
                'rt' => $rt->name,
                'data' => $data,
            ];
        }

        return [
            'labels' => $bulanLabels,
            'series' => $result,
        ];
    }
}
