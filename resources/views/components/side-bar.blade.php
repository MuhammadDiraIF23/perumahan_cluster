<!-- Sidebar -->
<aside id="sidebar"
  class="fixed inset-y-0 left-0 z-20 w-64 max-w-xs bg-gray-800 shadow-lg
  transform -translate-x-full transition-transform duration-300
  lg:translate-x-0 lg:static lg:inset-auto">

  <!-- Header Sidebar -->
  <div class="mb-8 flex items-center justify-between px-4 pt-4">
    <div class="flex items-center space-x-3">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8" />
      <h2 class="text-2xl font-bold text-gray-300">Admin RT</h2>
    </div>
    <button id="hamburger-btn" class="lg:hidden p-2" onclick="toggleSidebar()">
      <i class="bi bi-list text-2xl text-gray-300"></i>
    </button>
  </div>

  <!-- Navigasi -->
  <nav class="space-y-4 px-4">
    <a href="{{ route('admin.dashboard') }}"
       class="flex items-center space-x-3 text-gray-300 hover:text-white">
      <i class="bi bi-house-door"></i><span>Dashboard</span>
    </a>
    <a href="{{ route('admin.pengajuan-surat') }}"
       class="flex items-center space-x-3 text-gray-300 hover:text-white">
      <i class="bi bi-file-earmark-text"></i><span>Kelola Pengajuan Warga</span>
    </a>
    <a href="{{ route('admin.monitoring') }}"
       class="flex items-center space-x-3 text-gray-300 hover:text-white">
      <i class="bi bi-person-check"></i><span>Monitoring Tamu</span>
    </a>
    <a href="{{ route('admin.laporan') }}"
       class="flex items-center space-x-3 text-gray-300 hover:text-white">
      <i class="bi bi-bar-chart-line"></i><span>Laporan Wilayah</span>
    </a>
    <a href="{{ route('admin.dataUsers') }}"
       class="flex items-center space-x-3 text-gray-300 hover:text-white">
      <i class="bi bi-people"></i><span>Kelola Data User</span>
    </a>

    <!-- Logout -->
    <form action="{{ route('admin.logout') }}" method="POST" id="logoutForm">
      @csrf
      <button type="submit"
              class="flex items-center space-x-3 text-red-600 hover:text-red-800 w-full text-left">
        <i class="bi bi-box-arrow-right"></i><span>Logout</span>
      </button>
    </form>
  </nav>
</aside>

<!-- Include SweetAlert2 via CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script Toggle Sidebar dan Konfirmasi Logout -->
<script>
  // Fungsi toggle sidebar
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar) return;
    sidebar.classList.toggle('-translate-x-full');
  }

  // Pastikan DOM sudah siap sebelum pasang event listener
  document.addEventListener('DOMContentLoaded', function () {
    const logoutForm = document.getElementById("logoutForm");
    if (logoutForm) {
      logoutForm.addEventListener("submit", function (event) {
        event.preventDefault();

        Swal.fire({
          title: 'Yakin ingin logout?',
          text: "Sesi Anda akan diakhiri.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, logout',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            this.submit();
          }
        });
      });
    }
  });
</script>
