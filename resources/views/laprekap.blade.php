<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REKAP LAPORAN - OPERATOR</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        /* CSS Kustom dari kode awal Anda (untuk input date, select2, dll.) */
        input[type="date"]::-webkit-calendar-picker-indicator {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
            left: 0;
            top: 0;
        }
        .select2-selection__clear {
            display: none !important;
        }
        .select2-selection__arrow {
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
            #sidebar {
                transform: translateX(0) !important;
            }
        }
        [x-cloak] {
            display: none !important;
        }
        /* CSS Kustom Tambahan untuk Desain Baru */
        .bg-primary { background-color: #0D47A1; } /* Navy Blue Baru */
        .text-primary { color: #0D47A1; }
        .focus\:border-primary:focus { border-color: #0D47A1; }
        .focus\:ring-primary:focus { --tw-ring-color: #0D47A1; }
        .no-arrow::-ms-expand {
            display: none;
        }
        .no-arrow {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: none !important;
        }
    </style>
</head>
<body class="flex bg-[#EDF2F9]" x-data="layout">
    <aside id="sidebar" x-cloak class="fixed inset-y-0 left-0 z-50 w-64 bg-[#6685A9] text-white flex flex-col transition-transform duration-300 transform lg:translate-x-0 lg:min-h-screen overflow-y-auto" :class="{ 'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen }">
        <div class="px-3 py-2 bg-[#2E4269] flex items-center sticky top-0 z-10 shadow-md">
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
            <a href="/lapdashboard" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CCD5E1] transition-all duration-300 ease-in-out">
                <img src="/images/home.png" alt="Dashboard" class="w-5 h-5">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Dashboard</span>
            </a>
            <a href="/lapinput" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CCD5E1] transition-all duration-300 ease-in-out text-[#f6f6f6]">
                <img src="/images/input.png" alt="" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Tambahkan Laporan</span>
            </a>
            <a href="/laprekap" class="group flex items-center space-x-2 p-3 rounded bg-[#4F5F7C] hover:bg-[#CCD5E1] transition-all duration-300 ease-in-out">
                <img src="/images/daftar.png" alt="" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Rekap Laporan</span>
            </a>
        </nav>
        <div class="p-4 mt-auto lg:hidden">
            <button type="button" class="w-full flex items-center justify-center space-x-2 bg-[#4F5F7C] text-[#F6F6F6] font-bold px-3 py-3 rounded-md hover:bg-gray-400 transition-colors duration-300">
                <img src="/images/user.png" class="w-5 h-5" alt="user">
                <span>Log Out</span>
            </button>
        </div>
    </aside>

    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"></div>

    <div class="flex-1 flex flex-col lg:ml-64">
        <header class="flex items-center bg-[#A0B1C1] px-6 py-4 sticky top-0 z-30 shadow-md">
            <button @click="sidebarOpen = true" class="lg:hidden p-2 text-[#003B69] hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div class="ml-auto lg:ml-0 px-3 py-3 bg-[#4F5F7C] text-[#F6F6F6] font-bold rounded">
                OPERATOR
            </div>
            <div class="hidden lg:flex ml-auto">
                <button type="button" class="flex items-center space-x-2 bg-[#4F5F7C] text-[#F6F6F6] font-bold px-3 py-3 rounded-md hover:bg-gray-400 transition-colors duration-300">
                    <img src="/images/user.png" class="w-5 h-5" alt="user">
                    <span>Log Out</span>
                </button>
            </div>
        </header>

        <main class="p-4 sm:p-6 space-y-6">
            <h1 class="text-2xl font-bold text-[#003B69] ">Rekap Laporan Upload Konten YouTube</h1>

<div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0 md:space-x-4">

    <!-- Form Filter -->
    <form id="filterForm" method="GET" action="{{ url()->current() }}" class="flex items-center space-x-3 w-full md:w-auto">

        <!-- Cari Acara -->
        <div class="relative w-64">
            <select id="searchAcara" name="acara"
                class="w-full border-2 border-gray-300 rounded-lg py-2.5">
                <option value="">Cari Acara...</option>
                @foreach($laporan as $item)
                    <option value="{{ $item->acara }}" {{ request('acara') == $item->acara ? 'selected' : '' }}>
                        {{ $item->acara }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Cari Topik -->
        <div class="relative w-64">
            <select id="searchTopik" name="topik"
                class="w-full border-2 border-gray-300 rounded-lg py-2.5">
                <option value="">Cari Topik...</option>
                @foreach($laporan as $item)
                    @if(!empty($item->topik))
                        <option value="{{ $item->topik }}" {{ request('topik') == $item->topik ? 'selected' : '' }}>
                            {{ $item->topik }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Filter Bulan -->
        <div class="relative w-64">
            <select name="bulan"
                class="text-gray-400 no-arrow w-full border-2 border-gray-300 rounded-md pl-2 pr-3 py-2.5 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200 appearance-none">
                <option value="">Semua Bulan</option>
                @foreach ([
                    '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
                    '07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'
                ] as $num => $bulan)
                    <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                        {{ $bulan }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Reset -->
        <button type="button" id="resetFilter"
            class="flex items-center space-x-2 bg-[#2E4269] text-white font-semibold px-3 py-2 rounded-md shadow-md hover:bg-[#6685A9] transition-colors duration-300">
            <span>Reset</span>
        </button>
    </form>

    
    <a href="/lapinput" 
       class="w-full md:w-auto flex items-center justify-center space-x-2 bg-[#2E4269] text-white font-semibold px-4 py-3 rounded-md shadow-md hover:bg-[#6685A9] transition-colors duration-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span>Tambah Laporan Baru</span>
    </a>
</div>


            <div class="bg-white p-2 rounded-md shadow-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kegiatan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PRO</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acara & Topik</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Narasumber</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Media</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link YouTube</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-sm">
                        @foreach($laporan as $key => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $key + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->tanggal }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->pro->nama_pro ?? $item->id_pro }}</td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900">{{ $item->acara }}</p>
                                <p class="text-gray-500 text-xs">{{ $item->topik }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->narasumber }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->media }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-gray-900 text-sm"> <span class="font-semibold">{{ $item->operatorA->nama_operator ?? '-' }}</span></p>
                                <p class="text-gray-600 text-sm"> <span class="font-semibold">{{ $item->operatorB->nama_operator ?? '-' }}</span></p>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $shortLink = Str::limit($item->link_youtube, 25);
                                @endphp
                                <a href="{{ $item->link_youtube }}" target="_blank" 
                                    class="text-blue-600 hover:text-blue-800 truncate block max-w-[150px]">
                                    {{ $shortLink }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="/laporan/{{ $item->id_laporan }}/edit" 
                                class="text-primary hover:text-blue-800 font-semibold mr-2 p-1 rounded transition duration-150">Edit</a>
                                <form action="{{ route('laporan.destroy', $item->id_laporan) }}" method="POST" class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-600 hover:text-red-800 font-semibold p-1 rounded transition duration-150 delete-btn">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="flex justify-between items-center mt-4 p-4 bg-white rounded-md shadow-lg">
                <span class="text-sm text-gray-700">
                    Menampilkan 
                    <span class="font-semibold">{{ $laporan->firstItem() }}</span>
                    sampai 
                    <span class="font-semibold">{{ $laporan->lastItem() }}</span>
                    dari 
                    <span class="font-semibold">{{ $laporan->total() }}</span> hasil
                </span>

                <!-- Tombol Pagination -->
                <div class="flex space-x-3">
                    @if ($laporan->onFirstPage())
                        <button class="px-3 py-1 text-sm font-medium text-gray-400 bg-gray-100 rounded cursor-not-allowed">Previous</button>
                    @else
                        <a href="{{ $laporan->previousPageUrl() }}" 
                        class="px-3 py-1 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                        Previous
                        </a>
                    @endif

                    @foreach ($laporan->getUrlRange(1, $laporan->lastPage()) as $page => $url)
                        <a href="{{ $url }}" 
                        class="px-3 py-1 text-sm font-medium rounded 
                        {{ $page == $laporan->currentPage() ? 'bg-[#2E4269] text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        {{ $page }}
                        </a>
                    @endforeach

                    @if ($laporan->hasMorePages())
                        <a href="{{ $laporan->nextPageUrl() }}" 
                        class="px-3 py-1 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                        Next
                        </a>
                    @else
                        <button class="px-3 py-1 text-sm font-medium text-gray-400 bg-gray-100 rounded cursor-not-allowed">Next</button>
                    @endif
                </div>
            </div>
        </main>
        </div>

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
        });
        $(document).ready(function() {
            // Aktifkan Select2 pada dua input
            $('#searchAcara').select2({
                placeholder: 'Cari Acara...',
                allowClear: true,
                width: '100%'
            });
            $('#searchTopik').select2({
                placeholder: 'Cari Topik...',
                allowClear: true,
                width: '100%'
            });

            // Saat user memilih acara/topik, otomatis submit form filter
            $('#searchAcara, #searchTopik, select[name="bulan"]').on('change', function() {
                $('#filterForm').submit();
            });
        });
        // Tombol Reset Filter
        $('#resetFilter').on('click', function() {
            // Hapus semua nilai select2
            $('#searchAcara').val(null).trigger('change');
            $('#searchTopik').val(null).trigger('change');
            $('select[name="bulan"]').val('');

            // Reload halaman tanpa query string
            window.location.href = window.location.pathname;
        });
    </script>

    <script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    </script>

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
            customClass: { popup: 'rounded-xl shadow-lg' }
        });
    </script>
    @endif

</body>
</html>