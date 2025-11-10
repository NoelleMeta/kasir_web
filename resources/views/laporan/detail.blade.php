@extends('layouts.app')
@section('title','Laporan Detail')
@section('page_title','Laporan Detail Transaksi')
@push('head')
    {{-- Memuat CSS Bootstrap dari CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print { .no-print { display:none; } }
        .card { page-break-inside: avoid; }
        /* Sedikit penyesuaian agar pagination Bootstrap terlihat lebih rapi */
        .pagination {
            --bs-pagination-font-size: 0.9rem;
            --bs-pagination-padding-y: 0.4rem;
            --bs-pagination-padding-x: 0.8rem;
        }

        /* Date input styling */
        input[type="date"] {
            font-family: inherit;
            position: relative;
            color: transparent; /* Hide browser default text */
        }

        input[type="date"]:focus {
            color: transparent; /* Keep transparent on focus */
        }

        /* Show calendar icon but hide text */
        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            opacity: 1 !important; /* Force icon visibility */
            background: none !important; /* Remove any background */
            color: #6c757d !important; /* Icon color */
            filter: none !important; /* Remove any filters */
        }

        /* For Firefox */
        input[type="date"]::-moz-calendar-picker-indicator {
            cursor: pointer;
            opacity: 1 !important;
        }

        /* Hide the text part but keep the icon */
        input[type="date"]::-webkit-datetime-edit-text {
            color: transparent !important;
        }

        input[type="date"]::-webkit-datetime-edit-month-field,
        input[type="date"]::-webkit-datetime-edit-day-field,
        input[type="date"]::-webkit-datetime-edit-year-field {
            color: transparent !important;
        }

        /* Ensure the input itself doesn't hide the icon */
        input[type="date"] {
            -webkit-appearance: none;
            -moz-appearance: textfield;
        }

        input[type="date"]::-webkit-inner-spin-button,
        input[type="date"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Custom date display untuk format dd/mm/yyyy */
        .date-input-wrapper {
            position: relative;
            cursor: pointer; /* Show pointer cursor for entire wrapper */
        }

        .date-display {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #6c757d;
            font-size: 14px;
            z-index: 2;
            background: white;
            padding: 0 4px;
        }

        /* Make the entire input area clickable */
        .date-input-wrapper input[type="date"] {
            cursor: pointer;
        }

        input[type="date"]:focus + .date-display {
            color: #0d6efd;
        }

        /* Hide browser default placeholder */
        input[type="date"]::-webkit-input-placeholder {
            color: transparent;
        }

        input[type="date"]::-moz-placeholder {
            color: transparent;
        }

        input[type="date"]:-ms-input-placeholder {
            color: transparent;
        }

        input[type="date"]::placeholder {
            color: transparent;
        }

        /* Error styling untuk tanggal */
        .date-error {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
    </style>
@endpush
@section('actions')
    <div class="no-print">
        <a id="export-excel" href="{{ route('laporan.detail.excel', request()->query()) }}" class="btn btn-success me-2">Export Excel</a>
        <a id="export-pdf" href="{{ route('laporan.detail.pdf', request()->query()) }}" class="btn btn-danger">Export PDF</a>
    </div>
@endsection
@section('content')
    <div class="container mt-2">
        {{-- Form Filter --}}
        <form method="get" class="row g-2 align-items-end mb-3" id="filter-form">
            <div class="col-md-3">
                <label class="form-label">Periode</label>
                <select name="period" class="form-select">
                    <option value="" @if(!request('period')) selected @endif>Semua</option>
                    <option value="day" @if(request('period') == 'day') selected @endif>Hari ini</option>
                    <option value="yesterday" @if(request('period') == 'yesterday') selected @endif>Kemarin</option>
                    <option value="week" @if(request('period') == 'week') selected @endif>Minggu ini</option>
                    <option value="month" @if(request('period') == 'month') selected @endif>Bulan ini</option>
                    <option value="last_month" @if(request('period') == 'last_month') selected @endif>Bulan lalu</option>
                    <option value="range" @if(request('period') == 'range') selected @endif>Rentang Tanggal</option>
                </select>
            </div>
            <div class="col-md-3 range-field" style="display: none;">
                <label class="form-label">Dari</label>
                <div class="date-input-wrapper">
                    <input type="date" name="start_date" id="start_date_detail" class="form-control" value="{{ request('start_date') }}">
                    <span class="date-display" id="start_date_detail_display">dd/mm/yyyy</span>
                </div>
            </div>
            <div class="col-md-3 range-field" style="display: none;">
                <label class="form-label">Sampai</label>
                <div class="date-input-wrapper">
                    <input type="date" name="end_date" id="end_date_detail" class="form-control" value="{{ request('end_date') }}">
                    <span class="date-display" id="end_date_detail_display">dd/mm/yyyy</span>
                </div>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Terapkan Filter</button>
            </div>
        </form>

        {{-- Menampilkan Ringkasan Transaksi --}}
        <div id="transactions-summary" class="mb-3">
            @include('laporan.partials._transactions_summary', ['summary' => $summary])
        </div>

        {{-- Container ini HANYA memanggil @include SATU KALI untuk menampilkan daftar --}}
        <div id="transactions-list" style="position: relative;">
            @include('laporan.partials._transactions_list', ['transactions' => $transactions])
        </div>
    </div>
@endsection
@push('scripts')
    {{-- [PERBAIKAN] Skrip AJAX dan event handler dipusatkan di sini --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('filter-form');
        const listContainer = document.getElementById('transactions-list');
        const summaryContainer = document.getElementById('transactions-summary');
        const periodSelect = form.querySelector('select[name="period"]');
        const rangeFields = document.querySelectorAll('.range-field');

        function onPeriodChange(value) {
            rangeFields.forEach(el => {
                el.style.display = (value === 'range') ? 'block' : 'none';
            });
        }

        // Validasi tanggal untuk laporan detail
        const startDateInput = document.getElementById('start_date_detail');
        const endDateInput = document.getElementById('end_date_detail');
        const startDateDisplay = document.getElementById('start_date_detail_display');
        const endDateDisplay = document.getElementById('end_date_detail_display');

        // Fungsi untuk mengubah format tanggal dari yyyy-mm-dd ke dd/mm/yyyy
        function formatDateForDisplay(dateString) {
            if (!dateString) return 'dd/mm/yyyy';
            const [year, month, day] = dateString.split('-');
            return `${day}/${month}/${year}`;
        }

        // Update display saat input berubah
        function updateDateDisplay(input, display) {
            function updateDisplay() {
                const formattedDate = formatDateForDisplay(input.value);
                display.textContent = formattedDate;

                // Show formatted date jika ada value yang valid
                if (input.value) {
                    display.style.opacity = '1';
                    display.style.color = '#212529'; // Warna teks yang lebih gelap untuk value
                } else {
                    display.style.opacity = '1';
                    display.style.color = '#6c757d'; // Warna placeholder
                    display.textContent = 'dd/mm/yyyy';
                }
            }

            // Event listeners untuk input dan change
            input.addEventListener('input', updateDisplay);
            input.addEventListener('change', updateDisplay);

            // Set initial display
            updateDisplay();
        }

        // Initialize date displays untuk laporan detail
        if (startDateInput && startDateDisplay) {
            updateDateDisplay(startDateInput, startDateDisplay);
        }
        if (endDateInput && endDateDisplay) {
            updateDateDisplay(endDateInput, endDateDisplay);
        }

        // Set browser locale untuk format tanggal (jika didukung)
        if (startDateInput && endDateInput) {
            try {
                startDateInput.setAttribute('data-locale', 'id-ID');
                endDateInput.setAttribute('data-locale', 'id-ID');
            } catch (e) {
                console.log('Browser tidak mendukung locale setting untuk date input');
            }
        }

        // Function to open calendar programmatically
        function openCalendar(input) {
            // Focus the input first
            input.focus();

            // Try to trigger the date picker
            if (input.showPicker && typeof input.showPicker === 'function') {
                // Modern browsers support showPicker()
                input.showPicker();
            } else {
                // Fallback for older browsers - simulate click on calendar icon
                const event = new MouseEvent('click', {
                    view: window,
                    bubbles: true,
                    cancelable: true
                });
                input.dispatchEvent(event);
            }
        }

        // Add click handlers to date inputs and their wrappers
        function addCalendarClickHandlers(input, wrapper) {
            // Click on input itself
            input.addEventListener('click', function(e) {
                e.preventDefault();
                openCalendar(this);
            });

            // Click on wrapper (including the custom display)
            if (wrapper) {
                wrapper.addEventListener('click', function(e) {
                    e.preventDefault();
                    openCalendar(input);
                });
            }
        }

        // Apply click handlers untuk detail
        if (startDateInput) {
            const startDateWrapper = document.querySelector('.date-input-wrapper');
            addCalendarClickHandlers(startDateInput, startDateWrapper);
        }

        if (endDateInput) {
            const endDateWrapper = document.querySelectorAll('.date-input-wrapper')[1];
            addCalendarClickHandlers(endDateInput, endDateWrapper);
        }

        if (startDateInput && endDateInput) {
            // Event handler untuk tanggal "dari"
            startDateInput.addEventListener('change', function(){
                const startDate = this.value;
                const endDate = endDateInput.value;

                // Set minimum date untuk end_date
                endDateInput.min = startDate;

                // Jika end_date sudah dipilih dan lebih kecil dari start_date, reset
                if (endDate && endDate < startDate) {
                    endDateInput.value = '';
                }
            });

            // Event handler untuk tanggal "sampai"
            endDateInput.addEventListener('change', function(){
                const startDate = startDateInput.value;
                const endDate = this.value;

                // Validasi bahwa end_date tidak boleh sebelum start_date
                if (startDate && endDate < startDate) {
                    alert('Tanggal "Sampai" tidak boleh sebelum tanggal "Dari"');
                    this.value = '';
                    return;
                }
            });
        }

        periodSelect.addEventListener('change', (e) => onPeriodChange(e.target.value));

        // [PERBAIKAN] Fungsi loadContent dimodifikasi untuk menangani URL dengan lebih baik
        async function loadContent(url) {
            listContainer.style.opacity = '0.5';
            try {
                // Validate and clean URL before creating URL object
                let cleanUrl = url;
                if (!url.startsWith('http') && !url.startsWith('/')) {
                    cleanUrl = window.location.origin + '/' + url;
                } else if (url.startsWith('/')) {
                    cleanUrl = window.location.origin + url;
                }

                // Membuat objek URL dari href yang diklik. Ini lebih aman.
                const requestUrl = new URL(cleanUrl);

                // Ambil path dan parameter yang sudah ada
                const pathname = requestUrl.pathname;
                const searchParams = requestUrl.searchParams;

                // Buat URL untuk mengambil daftar transaksi
                searchParams.set('only_list', '1');
                const listFetchUrl = `${pathname}?${searchParams.toString()}`;

                // Buat URL untuk mengambil ringkasan
                // Hapus 'only_list' dulu agar bersih, lalu tambahkan 'only_summary'
                searchParams.delete('only_list');
                searchParams.set('only_summary', '1');
                const summaryFetchUrl = `${pathname}?${searchParams.toString()}`;

                const [listResponse, summaryResponse] = await Promise.all([
                    fetch(listFetchUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' }}),
                    fetch(summaryFetchUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                ]);

                if (!listResponse.ok || !summaryResponse.ok) {
                    throw new Error('Gagal mengambil data dari server.');
                }

                listContainer.innerHTML = await listResponse.text();
                summaryContainer.innerHTML = await summaryResponse.text();

                // Gunakan URL asli dari link untuk history
                history.pushState({}, '', url);
                updateExportLinks(url);

            } catch (error) {
                console.error("Gagal memuat konten:", error);
                listContainer.innerHTML = `<div class="alert alert-danger">Gagal memuat data. Error: ${error.message}. Silakan coba lagi.</div>`;
            } finally {
                listContainer.style.opacity = '1';
            }
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            params.delete('page');

            // Remove empty parameters to avoid invalid URLs
            for (const [key, value] of params.entries()) {
                if (!value || value.trim() === '') {
                    params.delete(key);
                }
            }

            const queryString = params.toString();
            const url = queryString ? `${window.location.pathname}?${queryString}` : window.location.pathname;
            loadContent(url);
        });

        listContainer.addEventListener('click', function(e) {
            const paginationLink = e.target.closest('.pagination a');
            if (paginationLink) {
                e.preventDefault();
                let url = paginationLink.getAttribute('href');
                if (url) {
                    // Clean URL before processing
                    let cleanUrl = url;
                    if (!url.startsWith('http') && !url.startsWith('/')) {
                        cleanUrl = window.location.origin + '/' + url;
                    } else if (url.startsWith('/')) {
                        cleanUrl = window.location.origin + url;
                    }

                    try {
                        const targetUrl = new URL(cleanUrl);
                        const safeUrl = window.location.origin + targetUrl.pathname + targetUrl.search;
                        loadContent(safeUrl);
                    } catch (error) {
                        console.error('Invalid pagination URL:', url, error);
                        // Fallback to direct URL
                        loadContent(url);
                    }
                }
                return;
            }

            const toggleButton = e.target.closest('.trx-toggle');
            if (toggleButton) {
                e.preventDefault();
                const targetId = toggleButton.getAttribute('data-target');
                const targetBody = document.getElementById(targetId);
                const caret = toggleButton.querySelector('.caret');

                if (targetBody) {
                    if (targetBody.style.display === 'none') {
                        targetBody.style.display = 'block';
                        if(caret) caret.innerHTML = '▴';
                    } else {
                        targetBody.style.display = 'none';
                        if(caret) caret.innerHTML = '▾';
                    }
                }
            }
        });

        function updateExportLinks(url) {
            try {
                // Clean URL before creating URL object
                let cleanUrl = url;
                if (!url.startsWith('http') && !url.startsWith('/')) {
                    cleanUrl = window.location.origin + '/' + url;
                } else if (url.startsWith('/')) {
                    cleanUrl = window.location.origin + url;
                }

                const currentParams = new URL(cleanUrl, window.location.origin).search;
                document.getElementById('export-excel').href = '{{ route("laporan.detail.excel") }}' + currentParams;
                document.getElementById('export-pdf').href = '{{ route("laporan.detail.pdf") }}' + currentParams;
            } catch (error) {
                console.error('Error updating export links:', error);
                // Fallback to current page parameters
                const currentParams = window.location.search;
                document.getElementById('export-excel').href = '{{ route("laporan.detail.excel") }}' + currentParams;
                document.getElementById('export-pdf').href = '{{ route("laporan.detail.pdf") }}' + currentParams;
            }
        }

        onPeriodChange(periodSelect.value);
    });
    </script>
@endpush
