<table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md mb-6 text-sm">
    <thead class="bg-gray-100 text-gray-600">
        <tr>
            <th class="px-4 py-2 text-left">Nama Pelapor</th>
            <th class="px-4 py-2 text-left">Nama Tamu</th>
            <th class="px-4 py-2 text-left">Nama Warga</th>
            <th class="px-4 py-2 text-left">Tujuan Rumah</th>
            <th class="px-4 py-2 text-left">No Rumah</th>
            <th class="px-4 py-2 text-left">Keperluan</th>
            <th class="px-4 py-2 text-left">Waktu Masuk</th>
            @if ($tipe === 'belum_keluar' || $tipe === 'melebihi_estimasi')
                <th class="px-4 py-2 text-left">Estimasi Keluar</th>
            @endif
            @if ($tipe === 'sudah_keluar')
                <th class="px-4 py-2 text-left">Waktu Keluar</th>
                <th class="px-4 py-2 text-left">Estimasi Keluar</th>
            @endif
            @if ($tipe === 'melebihi_estimasi')
                <th class="px-4 py-2 text-left">Durasi Terlambat</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse($tamus as $tamu)
            <tr class="border-t border-gray-200 hover:bg-gray-50">
                <td class="px-4 py-2">{{ optional($tamu->satpam->user)->nama ?? 'Tidak diketahui' }}</td>
                <td class="px-4 py-2">{{ $tamu->nama }}</td>
                <td class="px-4 py-2">{{ optional($tamu->warga->user)->nama ?? '-' }}</td>
                <td class="px-4 py-2">{{ $tamu->alamat_warga_tujuan }}</td>
                <td class="px-4 py-2">{{ $tamu->no_rumah_tujuan }}</td>
                <td class="px-4 py-2">{{ $tamu->alasan_kunjungan }}</td>
                <td class="px-4 py-2">
                    {{ \Carbon\Carbon::parse($tamu->waktu_masuk)->format('d M Y H:i') }}
                </td>

                @if ($tipe === 'belum_keluar' || $tipe === 'melebihi_estimasi')
                    <td class="px-4 py-2">
                        {{ \Carbon\Carbon::parse($tamu->estimasi_waktu_keluar)->format('d M Y H:i') }}
                    </td>
                @endif

                @if ($tipe === 'sudah_keluar')
                    <td class="px-4 py-2">
                        {{ $tamu->waktu_keluar ? \Carbon\Carbon::parse($tamu->waktu_keluar)->format('d M Y H:i') : '-' }}
                    </td>
                    <td class="px-4 py-2">
                        {{ \Carbon\Carbon::parse($tamu->estimasi_waktu_keluar)->format('d M Y H:i') }}
                    </td>
                @endif

                @if ($tipe === 'melebihi_estimasi')
                    <td class="px-4 py-2 text-red-600 font-semibold">
                        {{ now()->diff(\Carbon\Carbon::parse($tamu->estimasi_waktu_keluar))->format('%h jam %i menit') }}
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center py-4 text-gray-500">Tidak ada data</td>
            </tr>
        @endforelse
    </tbody>
</table>
