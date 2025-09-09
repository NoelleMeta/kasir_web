<!DOCTYPE html>
<html>
<head>
    <title>Laporan Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print { .no-print { display:none; } }
        .card { page-break-inside: avoid; }
    </style>
    </head>
<body>
    <div class="container mt-5">
        <h1>Laporan Detail Transaksi</h1>

        <form method="get" class="row g-2 align-items-end mb-3">
            <div class="col-md-3">
                <label class="form-label">Periode</label>
                <select name="period" class="form-select" onchange="onPeriodChange(this.value)">
                    <option value="" {{ (request('period')==null)?'selected':'' }}>Semua</option>
                    <option value="day" {{ request('period')=='day'?'selected':'' }}>Hari ini</option>
                    <option value="week" {{ request('period')=='week'?'selected':'' }}>Minggu ini</option>
                    <option value="month" {{ request('period')=='month'?'selected':'' }}>Bulan ini</option>
                    <option value="range" {{ request('period')=='range'?'selected':'' }}>Rentang Tanggal</option>
                </select>
            </div>
            <div class="col-md-3 range-field" style="display: none;">
                <label class="form-label">Dari</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3 range-field" style="display: none;">
                <label class="form-label">Sampai</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
        </form>

        <div class="d-flex justify-content-end mb-3 no-print">
            <a id="export-excel" href="{{ route('laporan.detail.excel') }}" class="btn btn-success me-2">Export ke Excel</a>
            <a id="export-pdf" href="{{ route('laporan.detail.pdf') }}" class="btn btn-danger">Export ke PDF</a>
        </div>

        <div id="transactions-list">
            @include('laporan.partials._transactions_list', ['transactions' => $transactions])
        </div>
    </div>
    <script>
        const form = document.querySelector('form');
        const listContainer = document.getElementById('transactions-list');
        const exportExcel = document.getElementById('export-excel');
        const exportPdf = document.getElementById('export-pdf');

        function onPeriodChange(value) {
            var fields = document.querySelectorAll('.range-field');
            fields.forEach(function(el){ el.style.display = (value === 'range') ? 'block' : 'none'; });
            if (value !== 'range') {
                // Auto apply when not range
                fetchAndRender();
            }
        }

        function buildQuery() {
            const params = new URLSearchParams(new FormData(form));
            params.set('only_list', '1');
            return params.toString();
        }

        function updateExportLinks() {
            const qs = new URLSearchParams(new FormData(form)).toString();
            exportExcel.href = '{{ route('laporan.detail.excel') }}' + (qs ? ('?' + qs) : '');
            exportPdf.href = '{{ route('laporan.detail.pdf') }}' + (qs ? ('?' + qs) : '');
        }

        async function fetchAndRender() {
            const query = buildQuery();
            updateExportLinks();
            const resp = await fetch(window.location.pathname + '?' + query, { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
            const html = await resp.text();
            listContainer.innerHTML = html;
        }

        form.addEventListener('submit', function(e){
            e.preventDefault();
            fetchAndRender();
        });

        // Auto apply when date range changes
        document.querySelectorAll('input[name=start_date], input[name=end_date]').forEach(function(input){
            input.addEventListener('change', function(){
                if (document.querySelector('select[name=period]').value === 'range') {
                    fetchAndRender();
                }
            });
        });

        // Polling for new data every 10s
        setInterval(fetchAndRender, 10000);

        // Initialize on load
        onPeriodChange("{{ request('period') }}");
        updateExportLinks();
    </script>
</body>
</html>
