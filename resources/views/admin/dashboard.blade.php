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

      <!-- Greeting -->
      <p class="text-gray-700 text-sm sm:text-base mb-4">
        Selamat datang di dashboard admin. Berikut fitur yang tersedia:
      </p>

      <!-- Features Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Fitur 1 -->
        <div class="bg-white p-4 rounded shadow">
          <h3 class="text-base sm:text-lg font-semibold mb-2 flex items-center gap-2">
            <i class="bi bi-pencil-square"></i> <span>Kelola Pengajuan Warga</span>
          </h3>
          <ul class="text-gray-600 text-sm list-disc pl-5">
            <li>Verifikasi permohonan</li>
            <li>Setujui atau tolak pengajuan</li>
          </ul>
        </div>

        <!-- Fitur 2 -->
        <div class="bg-white p-4 rounded shadow">
          <h3 class="text-base sm:text-lg font-semibold mb-2 flex items-center gap-2">
            <i class="bi bi-person-lines-fill"></i> <span>Monitoring Tamu</span>
          </h3>
          <ul class="text-gray-600 text-sm list-disc pl-5">
            <li>Lihat daftar tamu di rumah warga</li>
            <li>Data kunjungan wilayah</li>
          </ul>
        </div>

        <!-- Fitur 3 -->
        <div class="bg-white p-4 rounded shadow">
          <h3 class="text-base sm:text-lg font-semibold mb-2 flex items-center gap-2">
            <i class="bi bi-file-earmark-bar-graph"></i> <span>Laporan Wilayah</span>
          </h3>
          <ul class="text-gray-600 text-sm list-disc pl-5">
            <li>Jumlah tamu harian/bulanan</li>
            <li>Data pengajuan administrasi</li>
            <li>Laporan pengaduan</li>
          </ul>
        </div>
      </div>

      <!-- Tabel -->
      <div class="mt-8 overflow-x-auto">
        <h3 class="text-lg sm:text-xl font-semibold mb-4">Laporan Wilayah</h3>
        <table class="min-w-full bg-white border border-gray-200 rounded shadow-md text-sm sm:text-base">
          <thead class="bg-gray-100 text-gray-600">
            <tr>
              <th class="px-4 py-2 text-left">Nama</th>
              <th class="px-4 py-2 text-left">Jenis Pengajuan</th>
              <th class="px-4 py-2 text-left">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-t border-gray-200">
              <td class="px-4 py-2 text-gray-800">John Doe</td>
              <td class="px-4 py-2 text-gray-700">Surat Domisili</td>
              <td class="px-4 py-2 text-gray-700">Pending</td>
            </tr>
            <tr class="border-t border-gray-200">
              <td class="px-4 py-2 text-gray-800">Jane Smith</td>
              <td class="px-4 py-2 text-gray-700">Surat Keterangan Kelahiran</td>
              <td class="px-4 py-2 text-gray-700">Disetujui</td>
            </tr>
            <tr class="border-t border-gray-200">
              <td class="px-4 py-2 text-gray-800">Michael Johnson</td>
              <td class="px-4 py-2 text-gray-700">Kartu Keluarga</td>
              <td class="px-4 py-2 text-gray-700">Ditolak</td>
            </tr>
          </tbody>
        </table>
      </div>

    </main>
  </div>

  <x-footer />


</body>
</html>
