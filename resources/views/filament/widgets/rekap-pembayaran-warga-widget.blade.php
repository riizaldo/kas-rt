<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold mb-4">Rekap Pembayaran Warga - Bulan {{ now()->format('F Y') }}</h2>

        <div class="overflow-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-black-100">
                        <th class="px-2 py-1 border">Nama</th>
                        <th class="px-2 py-1 border">Blok</th>
                        @foreach ($iuranNames as $iuran)
                        <th class="px-2 py-1 border">{{ $iuran }}</th>
                        @endforeach
                        <th class="px-2 py-1 border">Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wargas as $warga)
                    <tr>
                        <td class="px-2 py-1 border">{{ $warga['nama'] }}</td>
                        <td class="px-2 py-1 border">{{ $warga['blok'] }}</td>
                        @foreach ($iuranNames as $iuran)
                        <td class="px-2 py-1 border text-center">{{ $warga['status'][$iuran] ?? '❌' }}</td>
                        @endforeach
                        <td class="px-2 py-1 border text-right">Rp {{ number_format($warga['total'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </x-filament::card>
</x-filament::widget>