<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin - Clustro</title>
  <link rel="icon" href="/favicon.ico" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="min-h-screen bg-[#f1f3f9] flex items-center justify-center px-4 font-[Inter]">
@if(session('login_success'))
<script>
  Swal.fire({
    icon: 'success',
    title: 'Login Berhasil!',
    text: 'Anda akan diarahkan ke dashboard...',
    showConfirmButton: false,
    timer: 2000,
    willClose: () => {
      window.location.href = "{{ route('admin.dashboard') }}";
    }
  });
</script>
@endif

  @if(session('error'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: "{{ session('error') }}",
        confirmButtonText: 'Coba Lagi'
      });
    </script>
  @endif

  <div class="w-full max-w-sm bg-white rounded-xl p-8 shadow-lg text-center">
    <h1 class="text-2xl font-bold text-gray-700 mb-2">Login Admin</h1>
    <p class="text-gray-500 text-sm mb-6">Silakan masukkan username dan password</p>

    <form id="loginForm" method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
      @csrf

      <!-- Username -->
      <input type="text" name="username" placeholder="Username" autocomplete="username"
        class="w-full px-5 py-3 text-base bg-[#f9fafb] border border-gray-300 rounded-full focus:ring-2 focus:ring-[#00C28C] focus:outline-none"
        required />

      <!-- Password dengan ikon toggle -->
      <div class="relative">
        <input type="password" id="password" name="password" placeholder="Password" autocomplete="current-password"
          class="w-full px-5 py-3 pr-12 text-base bg-[#f9fafb] border border-gray-300 rounded-full focus:ring-2 focus:ring-[#00C28C] focus:outline-none"
          required />
        <div class="absolute inset-y-0 right-4 flex items-center">
          <button type="button" id="togglePassword" class="focus:outline-none" aria-label="toggle password">
            <!-- Ikon Mata -->
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 text-gray-500"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.522 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
            </svg>
            <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 text-gray-500 hidden"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.977 9.977 0 012.042-3.338M6.7 6.7A9.955 9.955 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.965 9.965 0 01-4.128 5.148M3 3l18 18" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Tombol Login -->
      <button id="loginBtn" type="submit" aria-label="submit login"
        class="w-full py-3 text-base bg-[#00C28C] hover:bg-[#00a97a] active:bg-[#008f66] text-white rounded-full font-semibold transition">
        <span id="loginText">SIGN IN</span>
        <div id="loadingSpinner"
          class="hidden ml-2 w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin inline-block align-middle"></div>
      </button>
    </form>
  </div>

  <script>
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const loginText = document.getElementById('loginText');
    const loadingSpinner = document.getElementById('loadingSpinner');

    loginForm.addEventListener('submit', function (e) {
      e.preventDefault();
      loginBtn.disabled = true;
      loginText.innerText = "Processing...";
      loadingSpinner.classList.remove('hidden');
      setTimeout(() => {
        loginForm.submit();
      }, 1500);
    });

    // Toggle password visibility
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");
    const eyeIcon = document.getElementById("eyeIcon");
    const eyeOffIcon = document.getElementById("eyeOffIcon");

    togglePassword.addEventListener("click", function () {
      const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);
      eyeIcon.classList.toggle("hidden");
      eyeOffIcon.classList.toggle("hidden");
    });
  </script>
</body>

</html>
