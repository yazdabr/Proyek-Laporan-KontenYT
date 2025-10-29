<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD - OPERATOR</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
        input[type="date"] {
            appearance: none;
            -moz-appearance: none;
        }
        .select2-selection__clear, .select2-selection__arrow {
            display: none !important;
        }
        .select2-container .select2-selection--single {
            height: 45px !important;
            line-height: 45px !important;
            font-size: 16px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 45px !important;
            padding-left: 10px !important;
        }
        @media (min-width: 1024px) {
            #sidebar { transform: translateX(0) !important; }
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="flex bg-[#EDF2F9]" x-data="layout">
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
            <div class="text-xs font-bold uppercase tracking-wide text-white rounded [letter-spacing:4px] p-4 mb-3">Selamat Datang</div>
            <a href="/lapdashboard" class="group flex items-center space-x-2 p-3 rounded bg-[#1D3557] hover:bg-[#87CEFA] transition-all duration-300 ease-in-out">
                <img src="/images/home.png" alt="Dashboard" class="w-5 h-5">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Dashboard</span>
            </a>
            <a href="/lapinput" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#87CEFA] transition-all duration-300 ease-in-out text-[#f6f6f6]">
                <img src="/images/input.png" alt="" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Tambahkan Laporan</span>
            </a>
            <a href="/laprekap" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#87CEFA] transition-all duration-300 ease-in-out">
                <img src="/images/daftar.png" alt="" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Rekap Laporan</span>
            </a>
        </nav>
        <div class="p-4 mt-auto lg:hidden">
            <button type="button" class="w-full flex items-center justify-center space-x-2 bg-[#4F5F7C] text-[#F6F6F6] font-bold px-3 py-3 rounded hover:bg-gray-400">
                <img src="/images/user.png" class="w-5 h-5" alt="user">
                <span>Log Out</span>
            </button>
        </div>
    </aside>

    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"></div>

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
            <div class="hidden lg:flex ml-auto">
                <button type="button" class="flex items-center space-x-2 bg-[#1D3557] text-[#F6F6F6] font-bold px-3 py-3 rounded-md hover:bg-gray-400 transition-colors duration-300">
                    <img src="/images/user.png" class="w-5 h-5" alt="user">
                    <span>Log Out</span>
                </button>
            </div>
        </header>

        <main class="p-4 sm:p-6 space-y-6">
         
            <h1 class="text-2xl font-bold text-[#003B69]">Statistik Laporan Upload Konten YouTube</h1>
            
            {{-- Filter --}}
            <div class="bg-white p-4 rounded shadow">
                <h2 class="font-bold text-lg text-gray-700 mb-3">Filter Data Laporan</h2>
                <form id="filterForm" method="GET" action="{{ route('lapdashboard') }}" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 items-end">
                    <div class="w-full sm:w-64">
                        <label class="font-medium mb-1 block text-sm text-gray-600">Pilih Periode</label>
                        <div class="relative">
                            <select name="bulan" id="filterBulan" class="w-full border rounded px-3 py-2 text-gray-700 h-[45px] appearance-none">
                                <option value="">Semua Data (Total)</option>
                                @php
                                    $namaBulan = [
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember',
                                    ];
                                @endphp
                                @foreach ($daftarBulan as $b)
                                    <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                                        {{ $namaBulan[(int)$b] ?? $b }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-500">▼</div>
                        </div>
                    </div>
                        <a href="{{ route('lapdashboard') }}" class="bg-gray-400 text-white font-semibold px-4 py-2 rounded shadow hover:bg-gray-500 transition-colors duration-300 w-full sm:w-auto h-[45px] text-center">
                            Reset Filter
                        </a>
                    </div>
                </form>
            </div>
            
            {{-- Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded shadow border-l-4 border-[#003B69]">
                    <p class="text-sm font-medium text-gray-500">Total Semua Laporan</p>
                    <p class="text-3xl font-bold text-[#003B69] mt-1">{{ $totalLaporan }}</p>
                    <p class="text-xs text-gray-400 mt-2">Data Keseluruhan</p>
                </div>

                <div class="bg-white p-4 rounded shadow border-l-4 border-green-500">
                    <p class="text-sm font-medium text-gray-500">Laporan Operator A</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $totalA }}</p>
                    <p class="text-xs text-gray-400 mt-2">Operator A</p>
                </div>

                <div class="bg-white p-4 rounded shadow border-l-4 border-yellow-500">
                    <p class="text-sm font-medium text-gray-500">Laporan Operator B</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $totalB }}</p>
                    <p class="text-xs text-gray-400 mt-2">Operator B</p>
                </div>
            </div>
            
            {{-- Laporan Terbaru --}}
            <div class="bg-white p-4 sm:p-6 rounded shadow">
                <h2 class="font-bold text-xl text-[#003B69] mb-4">Laporan Upload Konten Terbaru</h2>
                <table class="w-full border-collapse text-sm sm:text-base">
                    <thead class="bg-[#003B69] text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Acara</th>
                            <th class="px-4 py-2 text-left">Topik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporanTerbaru as $lap)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($lap->tanggal)->translatedFormat('d M Y') }}</td>
                                <td class="px-4 py-2">{{ $lap->acara }}</td>
                                <td class="px-4 py-2">{{ $lap->topik }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-500 py-4">Belum ada laporan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('js/laporan.js') }}"></script>

</body>
</html>
