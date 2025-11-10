@extends('layouts.app')
@section('title','Laporan Ringkas')
@section('page_title','Laporan Penjualan Ringkas')
@push('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print { .no-print { display:none; } }
        .table thead th { background:#f1f5f9; }
        .table tfoot th { background:#f8fafc; }
        @media (max-width: 768px) {
            h1 {
                font-size: 1.5rem;
                text-align: center;
            }
            .btn { padding: .35rem .55rem; font-size: .9rem; }

            /* Mobile form improvements */
            .container { padding: 0 10px; }
            .row.g-2 { margin-bottom: 15px; }
            .col-md-3 { margin-bottom: 10px; }
            .form-label { font-size: 0.9rem; font-weight: 600; }
            .form-select, .form-control { font-size: 0.9rem; padding: 8px 10px; }

            /* Mobile table improvements */
            .table-responsive {
                border: none;
                margin: 0 -10px;
                font-size: 0.85rem;
            }
            .table {
                margin-bottom: 0;
                font-size: 0.8rem;
            }
            .table th, .table td {
                padding: 8px 6px;
                vertical-align: middle;
                white-space: nowrap;
            }
            .table th {
                font-size: 0.8rem;
                font-weight: 600;
                background: #f8f9fa !important;
            }

            /* Mobile-specific table layout */
            .table thead th:first-child { min-width: 120px; }
            .table thead th:nth-child(2) { min-width: 80px; }
            .table thead th:nth-child(3) { min-width: 70px; }
            .table thead th:last-child { min-width: 100px; }

            /* Mobile export buttons */
            .no-print {
                display: flex;
                flex-direction: column;
                gap: 8px;
                margin-bottom: 15px;
            }
            .no-print .btn {
                width: 100%;
                font-size: 0.9rem;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            /* Extra small mobile devices */
            .container { padding: 0 5px; }
            .table { font-size: 0.75rem; }
            .table th, .table td {
                padding: 6px 4px;
            }
            .form-label { font-size: 0.85rem; }
            .form-select, .form-control { font-size: 0.85rem; }

            /* Stack form elements vertically on very small screens */
            .row.g-2 .col-md-3 {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 8px;
            }
        }

        /* Loading animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Session expired notification */
        .session-expired {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #dc3545;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
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
        <a id="export-excel" href="{{ route('laporan.ringkas.excel') }}" class="btn btn-success me-2">Export Excel</a>
        <a id="export-pdf" href="{{ route('laporan.ringkas.pdf') }}" class="btn btn-danger">Export PDF</a>
    </div>
@endsection
@section('content')
    <div class="container mt-2">
    <form method="get" class="row g-2 align-items-end mb-3">
    <div class="col-md-3 col-sm-6 col-12">
                <label class="form-label">Periode</label>
                <select name="period" class="form-select" onchange="onPeriodChange(this.value, false)">
                    <option value="" {{ (request('period')==null)?'selected':'' }}>Semua</option>
                    <option value="day" {{ request('period')=='day'?'selected':'' }}>Hari ini</option>
                    <option value="yesterday" {{ request('period')=='yesterday'?'selected':'' }}>Kemarin</option>
                    <option value="week" {{ request('period')=='week'?'selected':'' }}>Minggu ini</option>
                    <option value="month" {{ request('period')=='month'?'selected':'' }}>Bulan ini</option>
                    <option value="last_month" {{ request('period')=='last_month'?'selected':'' }}>Bulan lalu</option>
                    <option value="range" {{ request('period')=='range'?'selected':'' }}>Rentang Tanggal</option>
                </select>
            </div>
            <div class="col-md-3 col-sm-6 col-12 range-field" style="display: none;">
                <label class="form-label">Dari</label>
                <div class="date-input-wrapper">
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                    <span class="date-display" id="start_date_display">dd/mm/yyyy</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 range-field" style="display: none;">
                <label class="form-label">Sampai</label>
                <div class="date-input-wrapper">
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                    <span class="date-display" id="end_date_display">dd/mm/yyyy</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
            </div>
        </form>

        <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th class="text-center">
                        <a class="text-decoration-none text-dark" href="{{ route('laporan.ringkas', array_merge(request()->query(), ['sort' => 'nama_produk', 'direction' => (isset($sort) && $sort==='nama_produk' && ($direction ?? 'desc')==='asc') ? 'desc' : 'asc'])) }}">
                            Nama Menu
                            @if(($sort ?? '') === 'nama_produk')
                                {!! ($direction ?? 'desc') === 'asc' ? '&#9650;' : '&#9660;' !!}
                            @endif
                        </a>
                    </th>
                    <th class="text-center">
                        <a class="text-decoration-none text-dark" href="{{ route('laporan.ringkas', array_merge(request()->query(), ['sort' => 'kategori', 'direction' => (isset($sort) && $sort==='kategori' && ($direction ?? 'desc')==='asc') ? 'desc' : 'asc'])) }}">
                            Kategori
                            @if(($sort ?? '') === 'kategori')
                                {!! ($direction ?? 'desc') === 'asc' ? '&#9650;' : '&#9660;' !!}
                            @endif
                        </a>
                    </th>
                    <th class="text-center">
                        <a class="text-decoration-none text-dark" href="{{ route('laporan.ringkas', array_merge(request()->query(), ['sort' => 'total_kuantitas', 'direction' => (isset($sort) && $sort==='total_kuantitas' && ($direction ?? 'desc')==='desc') ? 'asc' : 'desc'])) }}">
                            Jumlah Terjual
                            @if(($sort ?? '') === 'total_kuantitas')
                                {!! ($direction ?? 'desc') === 'desc' ? '&#9660;' : '&#9650;' !!}
                            @endif
                        </a>
                    </th>
                    <th class="text-center">
                        <a class="text-decoration-none text-dark" href="{{ route('laporan.ringkas', array_merge(request()->query(), ['sort' => 'total_pendapatan', 'direction' => (isset($sort) && $sort==='total_pendapatan' && ($direction ?? 'desc')==='desc') ? 'asc' : 'desc'])) }}">
                            Total Pendapatan
                            @if(($sort ?? '') === 'total_pendapatan')
                                {!! ($direction ?? 'desc') === 'desc' ? '&#9660;' : '&#9650;' !!}
                            @endif
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($reportData as $item)
                <tr>
                    <td class="text-start">{{ $item->nama_produk }}</td>
                    <td class="text-center">{{ $item->kategori }}</td>
                    <td class="text-center">{{ $item->total_kuantitas }}</td>
                    <td class="text-center">Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">GRAND TOTAL</th>
                    <th class="text-center">Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
@push('scripts')
<script>
    const form = document.querySelector('form');
    const exportExcel = document.getElementById('export-excel');
    const exportPdf = document.getElementById('export-pdf');

    function onPeriodChange(value, isInitialization = false) {
        console.log('onPeriodChange called with value:', value, 'type:', typeof value, 'isInitialization:', isInitialization);

        var fields = document.querySelectorAll('.range-field');
        fields.forEach(function(el){ el.style.display = (value === 'range') ? 'block' : 'none'; });

        // Hanya update export links, tidak ada navigasi otomatis
        updateExportLinks();
    }

    function updateExportLinks() {
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);

        // Remove empty parameters to avoid invalid URLs
        for (const [key, value] of params.entries()) {
            if (!value || value.trim() === '') {
                params.delete(key);
            }
        }

        const qs = params.toString();
        exportExcel.href = '{{ route('laporan.ringkas.excel') }}' + (qs ? ('?' + qs) : '');
        exportPdf.href = '{{ route('laporan.ringkas.pdf') }}' + (qs ? ('?' + qs) : '');
    }

    // Validasi tanggal dan event handlers
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const startDateDisplay = document.getElementById('start_date_display');
    const endDateDisplay = document.getElementById('end_date_display');

    // Fungsi untuk mengubah format tanggal dari yyyy-mm-dd ke dd/mm/yyyy
    function formatDateForDisplay(dateString) {
        if (!dateString) return 'dd/mm/yyyy';
        const [year, month, day] = dateString.split('-');
        return `${day}/${month}/${year}`;
    }

    // Fungsi untuk mengubah format tanggal dari dd/mm/yyyy ke yyyy-mm-dd
    function formatDateForInput(dateString) {
        if (!dateString || dateString === 'dd/mm/yyyy') return '';
        const [day, month, year] = dateString.split('/');
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
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

    // Initialize date displays
    updateDateDisplay(startDateInput, startDateDisplay);
    updateDateDisplay(endDateInput, endDateDisplay);

    // Set browser locale untuk format tanggal (jika didukung)
    if (startDateInput && endDateInput) {
        // Coba set locale Indonesia untuk date picker
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

    // Apply click handlers
    if (startDateInput) {
        const startDateWrapper = document.querySelector('.date-input-wrapper');
        addCalendarClickHandlers(startDateInput, startDateWrapper);
    }

    if (endDateInput) {
        const endDateWrapper = document.querySelectorAll('.date-input-wrapper')[1];
        addCalendarClickHandlers(endDateInput, endDateWrapper);
    }

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

        // Hanya update export links, tidak submit form
        updateExportLinks();
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

        // Hanya update export links, tidak submit form
        updateExportLinks();
    });


    // Initialize on load
    const currentPeriod = "{{ request('period') }}";
    console.log('Initializing with period:', currentPeriod);
    onPeriodChange(currentPeriod, true); // true = initialization

    // Deteksi session expired dan debugging
    document.addEventListener('DOMContentLoaded', function() {
        // Cek apakah ada parameter session_expired di URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('session_expired') === '1') {
            showSessionExpiredNotification();
        }

        // Debug: Log session info dan parameter
        console.log('Session info:', {
            url: window.location.href,
            cookies: document.cookie,
            timestamp: new Date().toISOString(),
            currentPeriod: urlParams.get('period'),
            allParams: Object.fromEntries(urlParams.entries())
        });
    });

    function showSessionExpiredNotification() {
        const notification = document.createElement('div');
        notification.className = 'session-expired';
        notification.innerHTML = `
            <strong>⚠️ Session Expired</strong><br>
            <small>Silakan login kembali untuk melanjutkan.</small>
            <button onclick="this.parentElement.remove()" style="float: right; background: none; border: none; color: white; font-size: 18px; cursor: pointer; margin-left: 10px;">&times;</button>
        `;
        document.body.appendChild(notification);

        // Auto remove setelah 5 detik
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 5000);
    }
</script>
@endpush
@endsection
