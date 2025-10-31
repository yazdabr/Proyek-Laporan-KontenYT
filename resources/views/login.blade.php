<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Upload Konten YT - Login</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-image: linear-gradient(135deg, #1e3d58 0%, #43b0f1 50%, #1e3d58 100%);
      background-attachment: fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

  <div class="bg-white rounded-2xl shadow-2xl flex flex-col md:flex-row w-full max-w-4xl overflow-hidden">

    <!-- Kolom kiri (gambar besar, desktop only) -->
    <div class="hidden md:flex md:w-1/2 bg-gray-50 items-center justify-center p-10">
      <img src="/images/logorri.png" alt="Logo RRI" class="w-56 h-auto">
    </div>

    <!-- Kolom kanan (form) -->
    <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
      
      <!-- Logo kecil, hanya muncul di mobile -->
      <div class="flex justify-center mb-4 md:hidden">
        <img src="/images/logorri.png" alt="Logo RRI" class="w-24 h-auto">
      </div>

      <h2 class="text-2xl font-extrabold text-gray-800 text-center">Selamat Datang</h2>
      <p class="text-center mb-6 text-sm">Silahkan Masukan Akun Anda</p>
      <div class="border-b border-gray-600/40 w-60 mx-auto mb-8"></div>

      {{-- FORM LOGIN --}}
      <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
        @csrf
        <!-- Username -->
        <div class="space-y-2">
          <label class="font-medium text-gray-700">Nama Pengguna</label>
          <div class="relative">
            <input type="text" name="username" placeholder="Masukkan Nama Pengguna"
              value="{{ old('username') }}"
              class="w-full pl-4 pr-4 py-3 border rounded-full text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition" required>
          </div>
        </div>

        <!-- Password -->
        <div class="space-y-2">
          <label class="font-medium text-gray-700">Kata Sandi</label>
          <div class="relative">
            <input type="password" name="password" placeholder="Masukkan kata sandi"
              class="w-full pl-4 pr-4 py-3 border rounded-full text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition" required>
          </div>
        </div>

        <!-- Tombol Login -->
        <button type="submit"
          class="w-full py-3 bg-[#4682B4] hover:bg-[#1e3d58] text-white font-semibold rounded-full transition duration-300">
          Masuk
        </button>
      </form>
    </div>
  </div>

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if($errors->has('login_error'))
  <script>
  Swal.fire({
    icon: 'error',
    title: 'Login Gagal',
    text: '{{ $errors->first("login_error") }}',
    position: 'top',
    toast: true,
    showConfirmButton: false,
    timer: 2200,
    timerProgressBar: true,
    backdrop: false,
    customClass: {
      popup: 'animate__animated animate__fadeInDown custom-toast'
    },
    didOpen: (toast) => {
      toast.style.width = '420px';
      toast.style.minHeight = '48px';
      toast.style.fontSize = '13px';
      toast.style.padding = '6px 12px';
    }
  });
  </script>
  @endif

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</body>
</html>
