<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Monitoring Tamu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { display: flex; flex-direction: column; min-height: 100vh; }
        footer { background-color: #808080; padding: 1rem; text-align: center; width: 100%; }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex flex-1 flex-col lg:flex-row flex-grow">
        <x-side-bar class="lg:w-64 w-full" />

        <main class="flex-1 p-8 bg-white rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Monitoring Tamu</h2>

            {{-- DAFTAR NAMA TAMU --}}
<div class="mb-10">
    <h3 class="text-xl font-bold mb-3 text-indigo-700">Daftar Nama Tamu</h3>

    {{-- Search Box --}}
    <div class="flex items-center justify-between mb-3">
        <form method="GET" action="{{ route('admin.monitoring') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIK..." class="px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300" />
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Cari</button>
        </form>
        <form method="GET" action="{{ route('admin.monitoring') }}">
            <button type="submit" class="text-sm text-gray-500 underline">Reset</button>
        </form>
    </div>

    {{-- Tabel Tamu --}}
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow mb-2 text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">NIK</th>
                <th class="px-4 py-2 text-left">Alamat</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $dataTampil = request('lihat') === 'semua' ? $semuaTamu : $semuaTamu->take(5);
            @endphp

            @forelse($dataTampil as $tamu)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $tamu->nama }}</td>
                    <td class="px-4 py-2">{{ $tamu->nik_tamu }}</td>
                    <td class="px-4 py-2">{{ $tamu->alamat }}</td>
                    <td class="px-4 py-2">
                        <form method="POST" action="{{ route('admin.tamu.destroy', $tamu->id) }}" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-gray-500 py-3">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tombol Lihat Semua --}}
    @if ($semuaTamu->count() > 5 && request('lihat') !== 'semua')
        <a href="{{ route('admin.monitoring', array_merge(request()->all(), ['lihat' => 'semua'])) }}"
            class="text-blue-600 hover:underline text-sm">Lihat Semua Data Tamu</a>
    @endif
</div>


            {{-- TAMU BELUM KELUAR --}}
            <h3 class="text-xl font-bold mb-3 text-blue-600">Tamu Belum Keluar</h3>
            @include('admin.monitoring-tamu-table', [
                'tamus' => $tamuBelumKeluar,
                'tipe' => 'belum_keluar'
            ])

            {{-- TAMU SUDAH KELUAR --}}
            <h3 class="text-xl font-bold mt-10 mb-3 text-green-600">Tamu Sudah Keluar</h3>
            @include('admin.monitoring-tamu-table', [
                'tamus' => $tamuSudahKeluar,
                'tipe' => 'sudah_keluar'
            ])

            {{-- TAMU MELEBIHI ESTIMASI --}}
            <h3 class="text-xl font-bold mt-10 mb-3 text-red-600">Tamu Melebihi Estimasi Waktu</h3>
            @include('admin.monitoring-tamu-table', [
                'tamus' => $tamuTelat,
                'tipe' => 'melebihi_estimasi'
            ])
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-[#808080] text-white p-4 text-center mt-auto">
        <p>&copy; 2025 Perumahan Cluster. All Rights Reserved.</p>
    </footer>
</body>
</html>
