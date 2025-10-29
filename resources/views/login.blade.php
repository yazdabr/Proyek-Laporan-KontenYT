<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PORTAL DATA TERPADU - Login</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts - Inter -->
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

  <!-- Wrapper -->
  <div class="bg-white rounded-2xl shadow-2xl flex flex-col md:flex-row w-full max-w-4xl overflow-hidden">

    <!-- Kolom kiri (gambar) -->
    <div class="hidden md:flex md:w-1/2 bg-gray-50 items-center justify-center p-10">
      <img src="/images/logorri.png" alt="Logo RRI" class="w-56 h-auto">
    </div>

    <!-- Kolom kanan (form) -->
    <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
      <h2 class="text-2xl font-extrabold text-gray-800 text-center">Selamat Datang</h2>
      <p class="text-center mb-6 text-sm">Silahkan Masukan Akun Anda</p>
      <div class="border-b border-gray-600/40 w-60 mx-auto mb-8"></div>

      <form action="#" method="POST" class="space-y-6">
        <!-- Username -->
        <div class="space-y-2">
          <label class="font-medium text-gray-700">Nama Pengguna</label>
          <div class="relative">
            <input type="text" placeholder="Masukkan Nama Pengguna"
              class="w-full pl-4 pr-4 py-3 border rounded-full text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
          </div>
        </div>

        <!-- Password -->
        <div class="space-y-2">
          <label class="font-medium text-gray-700">Kata Sandi</label>
          <div class="relative">
            </span>
            <input type="password" placeholder="Masukkan kata sandi"
              class="w-full pl-4 pr-4 py-3 border rounded-full text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
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

</body>
</html>
