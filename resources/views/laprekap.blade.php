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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
</head>
<body class="flex bg-[#EDF2F9]" x-data="rekapData()">
    <aside id="sidebar" x-cloak class="fixed inset-y-0 left-0 z-50 w-64 bg-[#4682B4] text-white flex flex-col transition-transform duration-300 transform lg:translate-x-0 lg:min-h-screen overflow-y-auto" :class="{ 'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen }">
        <div class="px-3 py-2 bg-[#1D3557] flex items-center sticky top-0 z-10 shadow-md">
            <img src="/images/logo.png" class="h-16" alt="Logo">
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
        <div class="p-4 mt-auto lg:hidden">
            <button type="button" class="w-full flex items-center justify-center space-x-2 bg-[#4F5F7C] text-[#F6F6F6] font-bold px-3 py-3 rounded-md hover:bg-[#87CEFA] transition-colors duration-300">
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
                <button type="button" class="flex items-center space-x-2 bg-[#1D3557] text-[#F6F6F6] font-bold px-3 py-3 rounded-md hover:bg-[#87CEFA] transition-colors duration-300">
                    <img src="/images/user.png" class="w-5 h-5" alt="user">
                    <span>Log Out</span>
                </button>
            </div>
        </header>

        <main class="p-4 sm:p-6 space-y-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 space-y-3 sm:space-y-0">
                <h1 class="text-xl md:text-2xl font-bold text-[#003B69]">
                    Rekap Laporan Upload Konten YouTube
                </h1>
                
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('laprekap.export', ['bulan' => request('bulan'), 'tahun' => request('tahun', date('Y'))]) }}" 
                    class="flex items-center justify-center space-x-2 bg-green-600 text-white font-semibold px-4 py-2 rounded-md shadow-md hover:bg-green-700 transition-colors duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h16V4H4zm4 10h8m-8-4h8M4 4l4 4m12-4l-4 4" />
                    </svg>
                    <span>Cetak Data</span>
                    </a>

                    <a href="/lapinput" 
                        class="flex items-center justify-center space-x-2 bg-[#2E4269] text-white font-semibold px-4 py-2 rounded-md shadow-md hover:bg-[#87CEFA] transition-colors duration-300 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Tambah Laporan</span>
                    </a>
                </div>
            </div>

            <div class="bg-white p-4 rounded-md shadow-lg">
                <form id="filterForm" method="GET" action="{{ url()->current() }}" 
                    class="flex flex-wrap gap-4 items-end">
                    
                    <div class="w-full sm:w-1/2 md:w-56 flex-grow">
                        <label for="searchAcara" class="text-sm font-medium text-gray-700 block mb-1">Acara</label>
                        <select id="searchAcara" name="acara" class="w-full border-2 border-gray-300 rounded-lg py-2.5">
                            <option value="">Cari Acara...</option>
                            @foreach($laporan as $item)
                                <option value="{{ $item->acara }}" {{ request('acara') == $item->acara ? 'selected' : '' }}>
                                    {{ $item->acara }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full sm:w-1/2 md:w-56 flex-grow">
                        <label for="searchOperator" class="text-sm font-medium text-gray-700 block mb-1">Operator</label>
                        <select id="searchOperator" name="operator" class="w-full border-2 border-gray-300 rounded-lg py-2.5">
                            <option value="">Cari Operator...</option>
                            @foreach($operator as $op)
                                <option value="{{ $op->id_operator }}" {{ request('operator') == $op->id_operator ? 'selected' : '' }}>
                                    {{ $op->nama_operator }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full sm:w-1/2 md:w-48 flex-grow">
                        <label for="filterBulan" class="text-sm font-medium text-gray-700 block mb-1">Bulan</label>
                        <select name="bulan" id="filterBulan"
                            class="text-gray-700 no-arrow w-full border-2 border-gray-300 rounded-md pl-2 pr-3 py-2.5 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200 appearance-none">
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

                    <div class="w-full md:w-auto mt-4 md:mt-0 flex-shrink-0">
                        <button type="button" id="resetFilter"
                            class="w-full md:w-auto flex items-center justify-center space-x-2 bg-[#2E4269] text-white font-semibold px-4 py-3 rounded-md shadow-md hover:bg-[#87CEFA] transition-colors duration-300">
                            <span>Reset Filter</span>
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="table-responsive bg-white p-2 rounded-md shadow-lg">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-10">No.</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">Tanggal Kegiatan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">PRO</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-48">Acara & Topik</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-36">Narasumber</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Media</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Operator</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Link YouTube</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider sticky-action header w-32">Aksi</th> 
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200 text-sm">
                        @foreach($laporan as $key => $item)
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $key + 1 }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $item->tanggal }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $item->pro->nama_pro ?? $item->id_pro }}</td>
                            <td class="px-4 py-4 max-w-xs overflow-hidden truncate">
                                <p class="font-semibold text-gray-900">{{ $item->acara }}</p>
                                <p class="text-gray-500 text-xs truncate">{{ $item->topik }}</p>
                            </td>
                            <td class="px-4 py-4">{{ $item->narasumber }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $item->media }}</td>

                            <td class="px-4 py-4">
                                <p class="text-gray-900 text-sm font-semibold whitespace-nowrap">
                                    {{ $item->operatorA->nama_operator ?? '-' }}
                                </p>
                                <p class="text-gray-600 text-sm whitespace-nowrap">
                                    {{ $item->operatorB->nama_operator ?? '-' }}
                                </p>
                            </td>

                            <div class="hidden setting-data" data-setting="{{ $item->setting }}"></div>

                            <td class="px-4 py-4 max-w-xs overflow-hidden truncate">
                                @php
                                    $fullLink = $item->link_youtube;
                                    $shortLink = (strlen($fullLink) > 25) ? substr($fullLink, 0, 25) . '...' : $fullLink;
                                @endphp
                                <a href="{{ $item->link_youtube }}" target="_blank" title="{{ $item->link_youtube }}"
                                    class="text-blue-600 hover:text-blue-800 block text-sm truncate">
                                    {{ $shortLink }}
                                </a>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap sticky-action **flex flex-col items-center justify-center**">
                                <button type="button"
                                    @click="showDetail({ 
                                        tanggal: '{{ $item->tanggal }}',
                                        pro: '{{ $item->pro->nama_pro ?? $item->id_pro }}',
                                        acara: '{{ $item->acara }}',
                                        topik: '{{ $item->topik }}',
                                        narasumber: '{{ $item->narasumber }}',
                                        media: '{{ $item->media }}',
                                        operatorA: '{{ $item->operatorA->nama_operator ?? '-' }}',
                                        operatorB: '{{ $item->operatorB->nama_operator ?? '-' }}',
                                        setting: '{{ $item->setting }}',
                                        link_youtube: '{{ $item->link_youtube }}' 
                                    })"
                                    class="text-green-600 hover:text-green-800 font-semibold text-xs p-1 rounded transition duration-150 block mb-1 w-full text-center">Lihat</button>
                                
                                <a href="/laporan/{{ $item->id_laporan }}/edit" 
                                class="text-primary hover:text-blue-800 font-semibold text-xs p-1 rounded transition duration-150 block mb-1 w-full text-center">Edit</a>
                                
                                <form action="{{ route('laporan.destroy', $item->id_laporan) }}" method="POST" class="inline-block delete-form w-full text-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-600 hover:text-red-800 font-semibold text-xs p-1 rounded transition duration-150 delete-btn w-full text-center">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <!-- Versi Card View (untuk mobile) -->
            <div class="card-view sm:hidden space-y-3">
                @foreach ($laporan as $item)
                    <div class="laporan-card p-4 rounded-xl border border-gray-200 shadow-sm bg-white">
                        <h3 class="font-semibold text-gray-800 text-base">{{ $item->acara }}</h3>
                        <p class="text-sm text-gray-600 mb-3">
                            <strong>Topik:</strong> {{ $item->topik }}
                        </p>

                        <div class="aksi flex items-center space-x-2">
                            <button type="button"
                                @click="showDetail({ 
                                    tanggal: '{{ $item->tanggal }}',
                                    pro: '{{ $item->pro->nama_pro ?? $item->id_pro }}',
                                    acara: '{{ $item->acara }}',
                                    topik: '{{ $item->topik }}',
                                    narasumber: '{{ $item->narasumber }}',
                                    media: '{{ $item->media }}',
                                    operatorA: '{{ $item->operatorA->nama_operator ?? '-' }}',
                                    operatorB: '{{ $item->operatorB->nama_operator ?? '-' }}',
                                    setting: '{{ $item->setting }}',
                                    link_youtube: '{{ $item->link_youtube }}' 
                                })"
                                class="bg-slate-500 text-white px-3 py-1.5 rounded-lg hover:bg-slate-600 transition text-sm flex-1 text-center">
                                Detail
                            </button>

                            <form action="{{ route('laporan.destroy', $item->id_laporan) }}" method="POST" class="delete-form flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                    class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 transition text-sm w-full delete-btn">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            </div> 
            
            <div class="flex flex-col sm:flex-row justify-between items-center mt-4 p-4 bg-white rounded-md shadow-lg space-y-3 sm:space-y-0">
                <span class="text-sm text-gray-700 order-2 sm:order-1">
                    Menampilkan 
                    <span class="font-semibold">{{ $laporan->firstItem() }}</span>
                    sampai 
                    <span class="font-semibold">{{ $laporan->lastItem() }}</span>
                    dari 
                    <span class="font-semibold">{{ $laporan->total() }}</span> hasil
                </span>

                <div class="flex space-x-2 order-1 sm:order-2">
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

    <div x-show="isDetailModalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="isDetailModalOpen" @click="isDetailModalOpen = false"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity ease-out duration-300" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="isDetailModalOpen"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="isDetailModalOpen = false">
                
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-bold text-gray-900 border-b pb-2 mb-3" id="modal-title">
                                Detail Laporan
                            </h3>
                            <div class="mt-2 text-sm text-gray-500 space-y-2">
                                <template x-for="(value, key) in detailData" :key="key">
                                    <div class="flex border-b border-gray-100 py-1.5">
                                        <div class="w-1/3 font-medium text-gray-700 capitalize" x-text="formatLabel(key)"></div>
                                        <div class="w-2/3 text-gray-900 break-words" x-html="formatValue(key, value)"></div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="isDetailModalOpen = false" type="button" 
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('js/laporan.js') }}"></script>

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