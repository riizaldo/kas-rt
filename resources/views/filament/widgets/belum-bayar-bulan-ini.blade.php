<x-filament::widget>
    <x-filament::card>
        {{-- <x-slot name="header">
            <h3 class="text-lg font-bold">Warga Belum Bayar Bulan {{ now()->translatedFormat('F Y') }}</h3>
        </x-slot> --}}
        <h3 class="text-lg font-bold">Warga Belum Bayar Bulan {{ now()->translatedFormat('F Y') }}</h3>
        <hr>
        <br>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-left">
                        <th>Nama</th>
                        <th>RT</th>
                        <th>Iuran</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr class="border-b">
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['rt'] }}</td>
                        <td>{{ $item['kategori_iuran'] }}</td>
                        <td>Rp {{ number_format($item['jumlah'], 0, ',', '.') }}</td>
                        <td class="text-red-600 font-semibold">{{ $item['status'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-400">Semua warga sudah membayar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-filament::card>
</x-filament::widget>
