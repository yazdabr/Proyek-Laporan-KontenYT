<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT LAPORAN - OPERATOR</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        input[type="date"]::-webkit-calendar-picker-indicator {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
            left: 0;
            top: 0;
        }
        .select2-selection__clear, .select2-selection__arrow { display: none !important; }
        .select2-container .select2-selection--single {
            height: 45px !important;
            line-height: 45px !important;
            font-size: 16px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 45px !important;
            padding-left: 10px !important;
        }
        @media (min-width: 1024px) { #sidebar { transform: translateX(0) !important; } }
        [x-cloak] { display: none !important; }
        .bg-primary { background-color: #0D47A1; }
        .text-primary { color: #0D47A1; }
        .focus\:border-primary:focus { border-color: #0D47A1; }
        .focus\:ring-primary:focus { --tw-ring-color: #0D47A1; }
    </style>
</head>
<body class="flex bg-[#EDF2F9]" x-data="layout">
    <!-- Sidebar -->
    <aside id="sidebar" x-cloak class="fixed inset-y-0 left-0 z-50 w-64 bg-[#4682B4] text-white flex flex-col transition-transform duration-300 transform lg:translate-x-0 lg:min-h-screen overflow-y-auto" :class="{ 'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen }">
        <div class="px-3 py-2 bg-[#1D3557] flex items-center sticky top-0 z-10 shadow-md">
            <img src="/images/logo.png" class="h-16">
            <button @click="sidebarOpen = false" class="lg:hidden ml-auto p-2 text-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <div class="text-xs font-bold uppercase tracking-wide text-white rounded [letter-spacing:4px] p-4 mb-3">
                Selamat Datang
            </div>
            <a href="/lapdashboard" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#87CEFA] transition-all duration-300 ease-in-out">
                <img src="/images/home.png" alt="Dashboard" class="w-5 h-5">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Dashboard</span>
            </a>
            <a href="/lapinput" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#87CEFA] transition-all duration-300 ease-in-out text-[#f6f6f6]">
                <img src="/images/input.png" alt="" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Tambahkan Laporan</span>
            </a>
            <a href="/laprekap" class="group flex items-center space-x-2 p-3 rounded bg-[#1D3557] hover:bg-[#87CEFA] transition-all duration-300 ease-in-out">
                <img src="/images/daftar.png" alt="" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Rekap Laporan</span>
            </a>
        </nav>
    </aside>

    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"></div>

    <!-- Header -->
    <div class="flex-1 flex flex-col lg:ml-64">
        <header class="flex items-center bg-[#4682B4] px-6 py-4 sticky top-0 z-30 shadow-md">
            <button @click="sidebarOpen = true" class="lg:hidden p-2 text-[#003B69] hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div class="ml-auto lg:ml-0 px-3 py-3 bg-[#1D3557] text-[#F6F6F6] font-bold rounded">
                OPERATOR
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-4 sm:p-6 space-y-6">
            <h1 class="text-2xl font-bold text-[#003B69]">Edit Laporan Upload Konten YouTube</h1>

            <form action="{{ route('laporan.update', $laporan->id_laporan) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Bagian 1 -->
                <div class="bg-white p-4 sm:p-4 rounded-md shadow-lg space-y-6">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4 flex items-center space-x-2 text-primary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.555-4.555A1 1 0 0019 4H5a1 1 0 00-.707 1.707L10 11.414V17a1 1 0 00.5.866l4 2A1 1 0 0016 19v-7a1 1 0 00-1-1z"/>
                        </svg>
                        <span>Informasi Konten</span>
                    </h2>

                    <div class="space-y-5">
                        <div>
                            <label class="font-semibold mb-2 block text-gray-700">Link YouTube</label>
                            <input type="url" name="link_youtube" value="{{ $laporan->link_youtube }}" required
                                class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>

                        <div>
                            <label class="font-semibold mb-2 block text-gray-700">Acara</label>
                            <input type="text" name="acara" value="{{ $laporan->acara }}"
                                class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>

                        <div>
                            <label class="font-semibold mb-2 block text-gray-700">Topik</label>
                            <input type="text" name="topik" value="{{ $laporan->topik }}"
                                class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>

                        <div>
                            <label class="font-semibold mb-2 block text-gray-700">Narasumber</label>
                            <input type="text" name="narasumber" value="{{ $laporan->narasumber }}"
                                class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                    </div>
                </div>

                <!-- Bagian 2 -->
                <div class="bg-white p-4 sm:p-4 rounded-md shadow-lg space-y-6 mt-8">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4 flex items-center space-x-2 text-primary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Detail Operasional</span>
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="col-span-1">
                            <label for="tanggal_kegiatan" class="font-semibold mb-2 block text-gray-700">Tanggal Kegiatan</label>
                            <div class="relative">
                                <input type="date" id="tanggal_kegiatan" name="tanggal" value="{{ $laporan->tanggal }}"
                                    class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-gray-600 pr-10 appearance-none bg-white focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                                    required>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-1">
                            <label for="pro_select" class="font-semibold mb-2 block text-gray-700">PRO</label>
                            <div class="relative w-full">
                                <select id="pro_select" name="id_pro" required
                                    class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-gray-600 appearance-none bg-white focus:border-primary focus:ring-1 focus:ring-primary transition duration-200">
                                    <option value="" disabled {{ !$laporan->id_pro ? 'selected' : '' }}>Pilih PRO</option>
                                    @foreach ($pros as $pro)
                                        <option value="{{ $pro->id_pro }}" {{ $laporan->id_pro == $pro->id_pro ? 'selected' : '' }}>
                                            {{ $pro->nama_pro }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-1 flex items-center pr-3 text-gray-500">▼</div>
                            </div>
                        </div>

                        <div class="col-span-1">
                            <label for="operator_a_select" class="font-semibold mb-2 block text-gray-700">Operator A</label>
                            <div class="relative w-full">
                                <select id="operator_a_select" name="operator_a"
                                    class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-gray-600 appearance-none bg-white focus:border-primary focus:ring-1 focus:ring-primary transition duration-200">
                                    <option value="" disabled {{ !$laporan->operator_a ? 'selected' : '' }}>Pilih Operator A</option>
                                    @foreach ($operators as $op)
                                        <option value="{{ $op->id_operator }}" {{ $laporan->operator_a == $op->id_operator ? 'selected' : '' }}>
                                            {{ $op->nama_operator }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-1 flex items-center pr-3 text-gray-500">▼</div>
                            </div>
                        </div>

                        <!-- Operator B -->
                        <div class="col-span-1">
                            <label for="operator_b_select" class="font-semibold mb-2 block text-gray-700">Operator B</label>
                            <div class="relative w-full">
                                <select id="operator_b_select" name="operator_b"
                                    class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-gray-600 appearance-none bg-white focus:border-primary focus:ring-1 focus:ring-primary transition duration-200">
                                    <option value="" disabled {{ !$laporan->operator_b ? 'selected' : '' }}>Pilih Operator B</option>
                                    @foreach ($operators as $op)
                                        <option value="{{ $op->id_operator }}" {{ $laporan->operator_b == $op->id_operator ? 'selected' : '' }}>
                                            {{ $op->nama_operator }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-1 flex items-center pr-3 text-gray-500">▼</div>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label class="font-semibold mb-2 block text-gray-700">Media</label>
                            <input type="text" name="media" value="{{ $laporan->media }}"
                                class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ route('laporan.index') }}" class="bg-gray-400 text-white font-semibold px-6 py-3 rounded-md shadow-lg hover:bg-gray-500 transition">Kembali</a>
                    <button type="submit" class="bg-[#2E4269] text-white font-semibold px-6 py-3 rounded-md shadow-lg hover:bg-[#6685A9] transition flex items-center space-x-2">
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </main>
    </div>

    @if (session('success'))
    <script>
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000,
            toast: true,
            background: '#2E4269',
            color: 'white',
        });
    </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('layout', () => ({
                sidebarOpen: window.innerWidth >= 1024,
                init() {
                    window.addEventListener('resize', () => {
                        this.sidebarOpen = window.innerWidth >= 1024;
                    });
                }
            }))
        })
    </script>
</body>
</html>
