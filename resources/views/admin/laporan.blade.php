<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  
    <style>
      body { display: flex; flex-direction: column; min-height: 100vh; }
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

  <!-- Wrapper -->
  <div class="flex flex-1 min-h-screen">

      @include('components.side-bar')


    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto">

      <!-- Mobile Header -->
      <div class="lg:hidden flex items-center justify-between bg-white p-4 rounded shadow mb-4">
        <button onclick="toggleSidebar()" class="p-2" id="hamburger-btn">
          <i class="bi bi-list text-2xl"></i>
        </button>
        <h1 class="text-xl font-bold text-gray-800 ml-2 flex-1">
          Halo, {{ Auth::guard('admin')->user()->username }}
        </h1>
      </div>


        <!-- Konten Utama -->
        <div class="flex-1 p-8 bg-white rounded-lg shadow-lg overflow-x-auto">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Laporan Wilayah</h2>

            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md table-auto">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Tipe Laporan</th>
                        <th class="px-6 py-3 text-left">Isi Laporan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $laporan)
                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-3 text-gray-800 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-3 capitalize text-gray-700 whitespace-nowrap">
                                {{ $laporan->jenis }}
                            </td>
                            <td class="px-6 py-3 text-gray-700">
                                {{ $laporan->deskripsi }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-center text-gray-500">
                                Belum ada laporan yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <x-footer class="mt-auto" />

</body>

</html>
