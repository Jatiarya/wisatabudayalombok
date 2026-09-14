<x-admin-layout title="Laporan">
    <div x-data x-init="$nextTick(() => lucide.createIcons())">

        {{-- Ringkasan --}}
        <div class="grid gap-4 sm:grid-cols-3 mb-6">
            <div class="glass-panel p-5 flex items-start justify-between">
                <div>
                    <p class="text-sm text-lombok-earth/60">Pesanan Selesai</p>
                    <p class="text-3xl font-bold text-lombok-earth mt-1">{{ $totalCompleted }}</p>
                </div>
                <div
                    class="h-10 w-10 shrink-0 rounded-full bg-lombok-forest/15 border border-lombok-forest/30 flex items-center justify-center text-lombok-forest">
                    <i data-lucide="flag" class="h-5 w-5"></i>
                </div>
            </div>
            <div class="glass-panel p-5 flex items-start justify-between">
                <div>
                    <p class="text-sm text-lombok-earth/60">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-lombok-earth mt-1">Rp
                        {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div
                    class="h-10 w-10 shrink-0 rounded-full bg-lombok-gold/15 border border-lombok-gold/30 flex items-center justify-center text-lombok-earth">
                    <i data-lucide="banknote" class="h-5 w-5"></i>
                </div>
            </div>
            <div class="glass-panel p-5 flex items-start justify-between">
                <div>
                    <p class="text-sm text-lombok-earth/60">Total Peserta</p>
                    <p class="text-3xl font-bold text-lombok-earth mt-1">{{ $totalParticipants }}</p>
                </div>
                <div
                    class="h-10 w-10 shrink-0 rounded-full bg-lombok-terracotta/15 border border-lombok-terracotta/30 flex items-center justify-center text-lombok-terracotta">
                    <i data-lucide="users" class="h-5 w-5"></i>
                </div>
            </div>
        </div>

        {{-- Filter bulan & tahun --}}
        <div class="flex flex-wrap items-end gap-3 mb-5">
            <div>
                <label class="text-xs font-medium text-lombok-earth/60 block mb-1">Bulan</label>
                <select id="filterMonth" class="input-glass text-sm">
                    <option value="">Semua Bulan</option>
                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}" @selected(request('month') == $m)>
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs font-medium text-lombok-earth/60 block mb-1">Tahun</label>
                <select id="filterYear" class="input-glass text-sm">
                    <option value="">Semua Tahun</option>
                    @foreach (range(now()->year, now()->year - 4) as $y)
                        <option value="{{ $y }}" @selected(request('year') == $y)>{{ $y }}</option>
                    @endforeach
                </select>
            </div>

            <a id="resetFilterBtn" href="{{ route('admin.bookings.report') }}" class="btn-outline-glass">
                <i data-lucide="x" class="h-4 w-4"></i>
                Reset
            </a>

            <a id="exportExcelBtn" href="{{ route('admin.bookings.report.export') }}"
                class="btn-outline-glass bg-green-500 text-white ml-auto">
                <i data-lucide="file-down" class="h-4 w-4"></i>
                Export Excel
            </a>
        </div>

        <div class="glass-panel p-2 datatable-glass-wrapper">
            <table id="reportTable" class="w-full text-sm" style="width:100%">
                <thead class="bg-white/30 backdrop-blur-sm text-left text-lombok-earth">
                    <tr>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Pelanggan</th>
                        <th class="px-4 py-3">Paket Trip</th>
                        <th class="px-4 py-3">Tanggal Aktivitas</th>
                        <th class="px-4 py-3">Peserta</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.11/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.11/js/jquery.dataTables.min.js"></script>

        <style>
            /* Skin DataTables biar nyatu sama tema glass */
            .datatable-glass-wrapper .dataTables_wrapper {
                padding: 0.5rem;
            }

            .datatable-glass-wrapper table.dataTable {
                border-collapse: collapse !important;
            }

            .datatable-glass-wrapper table.dataTable tbody tr {
                border-top: 1px solid rgba(255, 255, 255, 0.4);
            }

            .datatable-glass-wrapper table.dataTable tbody tr:hover {
                background: rgba(255, 255, 255, 0.2);
            }

            .datatable-glass-wrapper table.dataTable td {
                padding: 0.75rem 1rem;
                vertical-align: middle;
            }

            .datatable-glass-wrapper .dataTables_filter input,
            .datatable-glass-wrapper .dataTables_length select {
                background: rgba(255, 255, 255, 0.5);
                border: 1px solid rgba(255, 255, 255, 0.6);
                border-radius: 0.5rem;
                padding: 0.35rem 0.6rem;
                font-size: 0.8rem;
                margin-left: 0.4rem;
            }

            .datatable-glass-wrapper .dataTables_info,
            .datatable-glass-wrapper .dataTables_length,
            .datatable-glass-wrapper .dataTables_filter {
                padding: 0.5rem 0.75rem;
                font-size: 0.8rem;
                color: #8b5e34;
            }

            .datatable-glass-wrapper .dataTables_paginate {
                padding: 0.5rem 0.75rem;
            }

            .datatable-glass-wrapper .dataTables_paginate .paginate_button {
                padding: 0.3rem 0.7rem;
                margin-left: 0.25rem;
                border-radius: 9999px;
                border: 1px solid rgba(255, 255, 255, 0.5) !important;
                background: rgba(255, 255, 255, 0.4) !important;
                color: #8b5e34 !important;
                font-size: 0.8rem;
            }

            .datatable-glass-wrapper .dataTables_paginate .paginate_button.current {
                background: #8b5e34 !important;
                color: #fff !important;
                border-color: #8b5e34 !important;
            }

            .datatable-glass-wrapper .dataTables_paginate .paginate_button.disabled {
                opacity: 0.4;
            }
        </style>

        <script>
            $(function() {
                const table = $('#reportTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.bookings.report.data') }}",
                        data: function(d) {
                            d.month = $('#filterMonth').val();
                            d.year = $('#filterYear').val();
                        }
                    },
                    columns: [{
                            data: 'booking_code',
                            name: 'booking_code'
                        },
                        {
                            data: 'customer',
                            name: 'user.name',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'trip_name',
                            name: 'trip.name',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'departure_date',
                            name: 'departure_date'
                        },
                        {
                            data: 'participants',
                            name: 'participants'
                        },
                        {
                            data: 'total_price',
                            name: 'total_price'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-right'
                        },
                    ],
                    order: [
                        [3, 'desc']
                    ],
                    language: {
                        search: '',
                        searchPlaceholder: 'Cari kode, pelanggan, atau trip...',
                        lengthMenu: '_MENU_ per halaman',
                        info: 'Menampilkan _START_–_END_ dari _TOTAL_ data',
                        infoEmpty: 'Tidak ada data',
                        infoFiltered: '(disaring dari _MAX_ total data)',
                        zeroRecords: 'Tidak ada pesanan yang cocok.',
                        emptyTable: 'Belum ada pesanan yang selesai.',
                        paginate: {
                            previous: '‹',
                            next: '›'
                        },
                    },
                    drawCallback: function() {
                        // ikon lucide di baris baru (kolom aksi) perlu di-render ulang
                        if (window.lucide) lucide.createIcons();
                    },
                });

                function updateExportLink() {
                    const params = new URLSearchParams();
                    if ($('#filterMonth').val()) params.set('month', $('#filterMonth').val());
                    if ($('#filterYear').val()) params.set('year', $('#filterYear').val());
                    $('#exportExcelBtn').attr('href', "{{ route('admin.bookings.report.export') }}?" + params
                    .toString());
                }

                $('#filterMonth, #filterYear').on('change', function() {
                    table.ajax.reload();
                    updateExportLink();
                });

                $('#resetFilterBtn').on('click', function(e) {
                    e.preventDefault();
                    $('#filterMonth').val('');
                    $('#filterYear').val('');
                    table.ajax.reload();
                    updateExportLink();
                });

                updateExportLink();
            });
        </script>
    @endpush
</x-admin-layout>
