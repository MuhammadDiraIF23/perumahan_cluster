<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Pengajuan Warga</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        footer {
            background-color: #808080;
            padding: 1rem;
            text-align: center;
            width: 100%;
        }
        body 
        { display: flex; flex-direction: column; min-height: 100vh; }
        footer { background-color: #808080; padding: 1rem; text-align: center; width: 100%; }
    </style>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

     <!-- SweetAlert success -->
  @if(session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: "{{ session('success') }}",
      showConfirmButton: false,
      timer: 2000
    });
  </script>
  @endif

    <!-- Wrapper utama -->
    <div class="flex flex-1 min-h-0">
        {{-- Sidebar --}}
        @include('components.side-bar')

        {{-- Main content --}}
        <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto">
            {{-- Header mobile --}}
            <div class="lg:hidden flex items-center space-x-3 bg-white p-4 rounded-lg shadow mb-6">
                <button onclick="toggleSidebar()" class="p-2">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800 flex-1 ml-4">
                    Halo, {{ Auth::guard('admin')->user()->username }}
                </h1>
            </div>

            {{-- Judul halaman --}}
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Pengajuan Warga</h1>

            {{-- Tabel --}}
            <div class="bg-white rounded-lg shadow-lg overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="px-6 py-3 text-left">Nama Warga</th>
                            <th class="px-6 py-3 text-left">Jenis Surat</th>
                            <th class="px-6 py-3 text-left">Keterangan</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengajuanSurats as $surat)
                            <tr class="border-t border-gray-200">
                                <td class="px-6 py-3 text-gray-800">{{ $surat->user->nama ?? 'Tidak Ditemukan' }}</td>
                                <td class="px-6 py-3 text-gray-700">{{ $surat->jenis_surat }}</td>
                                <td class="px-6 py-3 text-gray-700">{{ $surat->keterangan }}</td>
                                <td class="px-6 py-3">
                                    <span class="px-3 py-1 text-sm rounded-full 
                                        {{ $surat->status === 'Disetujui' ? 'bg-green-100 text-green-800' : ($surat->status === 'Ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ $surat->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-3">
                                    <form method="POST" action="{{ route('admin.pengajuan-surat.update-status', $surat->id) }}">
                                        @csrf
                                        <select name="status" class="rounded border-gray-300">
                                            <option value="Menunggu Persetujuan" {{ $surat->status === 'Menunggu Persetujuan' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                                            <option value="Disetujui" {{ $surat->status === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="Ditolak" {{ $surat->status === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                        <input type="text" name="alasan_penolakan" placeholder="Alasan (jika ditolak)" class="mt-2 rounded border-gray-300 p-1"
                                            value="{{ $surat->alasan_penolakan }}">
                                        <button type="submit" class="ml-2 px-3 py-1 bg-blue-500 text-white rounded">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-3 text-center text-gray-500">Belum ada pengajuan surat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    {{-- Footer di luar div utama --}}
    <x-footer />

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            if (!sidebar) return;
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
</body>
</html>
