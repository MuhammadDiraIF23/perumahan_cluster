<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Data Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        footer {
            background-color: #808080;
            padding: 1rem;
            text-align: center;
            color: white;
        }
    </style>
</head>

<body class="bg-gray-100">

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


    <!-- Wrapper Sidebar & Konten -->
    <div class="flex flex-1 flex-col lg:flex-row flex-grow">

        <!-- Sidebar -->
        <x-side-bar class="lg:w-64 w-full" />

        <!-- Konten Utama -->
        <main class="flex-1 p-8 bg-white rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Kelola Data Pengguna</h2>


            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('admin.dataUsers') }}" class="mb-6 flex gap-2">
                <input type="text" name="search" placeholder="Cari nama/email..." value="{{ request('search') }}"
                    class="w-full px-4 py-2 border rounded shadow-sm" />
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Cari</button>
            </form>

            <!-- Warga -->
            <h3 class="text-xl font-bold text-gray-700 mt-4 mb-2">👤 Warga</h3>
            <x-user-table :users="$users->filter(fn($u) => $u->primaryRole?->name === 'warga')" />

            <!-- Satpam -->
            <h3 class="text-xl font-bold text-gray-700 mt-8 mb-2">🛡️ Satpam</h3>
            <x-user-table :users="$users->filter(fn($u) => $u->primaryRole?->name === 'satpam')" />
            
        </main>
        
    </div>

        <!-- Footer -->
        <footer class="bg-[#808080] text-white p-4 text-center mt-auto">
            <p>&copy; 2025 Perumahan Cluster. All Rights Reserved.</p>
        </footer>
    
</body>

</html>
