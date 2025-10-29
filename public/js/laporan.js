
        // =========================================================
        // ALPINE.JS DATA & LOGIC
        // =========================================================
        document.addEventListener('alpine:init', () => {
            Alpine.data('layout', () => ({
                // Pastikan di mobile (<= 1024px) sidebar tertutup secara default
                sidebarOpen: window.innerWidth >= 1024,
                init() {
                    window.addEventListener('resize', () => {
                        this.sidebarOpen = window.innerWidth >= 1024;
                    });
                }
            }))

            Alpine.data('rekapData', () => ({
                sidebarOpen: window.innerWidth >= 1024,
                isDetailModalOpen: false,
                detailData: {},

                init() {
                    // Logika Resize Sidebar
                    window.addEventListener('resize', () => {
                        this.sidebarOpen = window.innerWidth >= 1024;
                    });
                },

                showDetail(item) {
                    // Format data setting agar lebih rapih (misal: ganti koma dengan baris baru)
                    let settingFormatted = item.setting.split(',').map(s => `<li>${s.trim()}</li>`).join('');
                    settingFormatted = `<ul>${settingFormatted}</ul>`;

                    this.detailData = {
                        tanggal: item.tanggal,
                        pro: item.pro,
                        acara: item.acara,
                        topik: item.topik,
                        narasumber: item.narasumber,
                        media: item.media,
                        operatorA: item.operatorA,
                        operatorB: item.operatorB,
                        // Data setting menggunakan format khusus untuk ditampilkan
                        setting: settingFormatted, 
                        link_youtube: item.link_youtube
                    };
                    this.isDetailModalOpen = true;
                },

                formatLabel(key) {
                    // Helper untuk mengubah key (camelCase) menjadi label yang rapi
                    const labels = {
                        tanggal: 'Tanggal Kegiatan',
                        pro: 'PRO',
                        acara: 'Acara',
                        topik: 'Topik',
                        narasumber: 'Narasumber',
                        media: 'Media',
                        operatorA: 'Operator A',
                        operatorB: 'Operator B',
                        setting: 'Setting Kamera, Sound & Panggung',
                        link_youtube: 'Link YouTube'
                    };
                    return labels[key] || key;
                },

                formatValue(key, value) {
                    // Tampilkan link sebagai tautan yang bisa diklik
                    if (key === 'link_youtube' && value) {
                        return `<a href="${value}" target="_blank" class="text-blue-600 hover:text-blue-800 break-all">${value}</a>`;
                    }
                    // Tampilkan data setting sebagai list (sudah di format di showDetail)
                    if (key === 'setting') {
                        return value;
                    }
                    return value;
                }
            }));
        });

        // =========================================================
        // JQUERY & SWEETALERT LOGIC
        // =========================================================
        $(document).ready(function() {
            // Select2 untuk filter Acara, Operator, dan Bulan
            $('#searchAcara').select2({
                placeholder: 'Cari Acara...',
                allowClear: true,
                width: '100%'
            });

            $('#searchOperator').select2({
                placeholder: 'Cari Operator...',
                allowClear: true,
                width: '100%'
            });

            $('#filterBulan').select2({
                placeholder: 'Pilih Periode...',
                allowClear: true,
                width: '100%'
            }).on('change', function() {
                $('#filterForm').submit();
            });

            // Auto submit untuk Select2 lainnya
            $('#searchAcara, #searchOperator').on('change', function() {
                $('#filterForm').submit();
            });

            // Reset filter
            $('#resetFilter').on('click', function() {
                $('#searchAcara').val(null).trigger('change');
                $('#searchOperator').val(null).trigger('change');
                $('#filterBulan').val(null).trigger('change');
                window.location.href = window.location.pathname;
            });
        });


        // Logika SweetAlert
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
