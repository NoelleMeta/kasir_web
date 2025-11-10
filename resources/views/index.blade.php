@extends('layouts.app')
@section('title','Dashboard')
@section('page_title','Dashboard Penjualan')
@push('head')
    <style>
        .container { max-width: 1000px; margin: 0; padding: 0; }
        .cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .card { background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.06); }
        .card h3 { margin: 0 0 8px 0; font-size: 13px; color: #475569; font-weight: 600; }
        .metric { font-size: 22px; font-weight: 700; color: #1e293b; }
        .section { margin-top: 24px; }

        /* [TAMBAHAN] CSS untuk membuat judul dan periode sejajar */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        .section-header h3 {
            margin: 0;
            color: #334155;
            font-size: 16px;
        }
        .section-header .periode-label {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        /* [TAMBAHAN] CSS untuk indikator periode di sudut kanan atas */
        .period-indicator {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .period-indicator:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
        }
        .period-indicator .icon {
            font-size: 18px;
        }
        .period-indicator .text {
            font-size: 16px;
            font-weight: 600;
        }

        /* [TAMBAHAN] CSS untuk modal popup periode */
        .period-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }
        .period-modal.show {
            display: flex;
        }
        .period-modal-content {
            background: white;
            border-radius: 16px;
            padding: 24px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            animation: modalSlideIn 0.3s ease;
        }
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .period-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .period-modal-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }
        .period-modal-close {
            background: none;
            border: none;
            font-size: 24px;
            color: #64748b;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        .period-modal-close:hover {
            background: #f1f5f9;
            color: #1e293b;
        }
        .period-form-group {
            margin-bottom: 16px;
        }
        .period-form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        .period-form-select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: border-color 0.2s ease;
        }
        .period-form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .period-modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
        }
        .period-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }
        .period-btn-secondary {
            background: #f1f5f9;
            color: #64748b;
        }
        .period-btn-secondary:hover {
            background: #e2e8f0;
        }
        .period-btn-primary {
            background: #3b82f6;
            color: white;
        }
        .period-btn-primary:hover {
            background: #2563eb;
        }

        /* [TAMBAHAN] Responsive modal untuk mobile */
        @media (max-width: 640px) {
            .period-modal-content {
                max-width: 95%;
                width: 95%;
                margin: 20px;
                padding: 20px;
            }
            .period-modal-title {
                font-size: 16px;
            }
            .period-form-select {
                padding: 14px;
                font-size: 16px; /* Mencegah zoom di iOS */
            }
            .period-btn {
                padding: 12px 24px;
                font-size: 16px;
            }
        }

        /* [TAMBAHAN] CSS untuk pesan error tidak ada data */
        .no-data-message {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }
        .no-data-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.6;
        }
        .no-data-message h3 {
            color: #dc2626;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .no-data-message p {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 24px;
            line-height: 1.6;
        }
        .no-data-suggestions {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            text-align: left;
            max-width: 500px;
            margin: 0 auto;
        }
        .no-data-suggestions p {
            color: #374151;
            font-weight: 600;
            margin-bottom: 12px;
        }
        .no-data-suggestions ul {
            color: #6b7280;
            padding-left: 20px;
            margin: 0;
        }
        .no-data-suggestions li {
            margin-bottom: 8px;
            line-height: 1.5;
        }

        @media (max-width: 640px) {
            .period-indicator {
                top: auto;
                bottom: 20px;
                right: 20px;
                left: auto;
                padding: 12px 16px;
                font-size: 14px;
                position: fixed;
                z-index: 1000;
                box-shadow: 0 4px 16px rgba(59, 130, 246, 0.4);
                border-radius: 50px;
                min-width: 120px;
                justify-content: center;
                backdrop-filter: blur(10px);
                background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            }
            .period-indicator .icon {
                font-size: 16px;
            }
            .period-indicator .text {
                font-size: 14px;
                font-weight: 600;
            }
            .period-indicator:hover {
                transform: translateY(-2px) scale(1.05);
                box-shadow: 0 6px 20px rgba(59, 130, 246, 0.5);
            }
        }

        table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 2px rgba(0,0,0,0.06); }
        th, td { padding: 12px 14px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 14px; }
        th { background: #f1f5f9; color: #334155; font-weight: 600; }
        tr:last-child td { border-bottom: none; }

        @media (max-width: 900px) { .cards { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) {
            .container { padding: 0 12px; }
            .metric { font-size: 20px; }
            .cards { grid-template-columns: 1fr; }
            th, td { padding: 10px 12px; font-size: 13px; }
        }
    </style>
@endpush
@section('content')
    <!-- [TAMBAHAN] Indikator periode di sudut kanan atas -->
    <div class="period-indicator" id="periodIndicator">
        <span class="icon">📅</span>
        <span class="text">Data {{ $periodeDashboard }}</span>
    </div>

    <!-- [TAMBAHAN] Modal popup untuk memilih periode -->
    <div class="period-modal" id="periodModal">
        <div class="period-modal-content">
            <div class="period-modal-header">
                <h3 class="period-modal-title">Pilih Periode Data</h3>
                <button class="period-modal-close" id="periodModalClose">&times;</button>
            </div>
            <form id="periodForm">
                <div class="period-form-group">
                    <label class="period-form-label" for="selectedMonth">Bulan</label>
                    <select class="period-form-select" id="selectedMonth" name="month">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="period-form-group">
                    <label class="period-form-label" for="selectedYear">Tahun</label>
                    <select class="period-form-select" id="selectedYear" name="year">
                        @for($year = now()->year; $year >= now()->year - 5; $year--)
                            <option value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="period-modal-actions">
                    <button type="button" class="period-btn period-btn-secondary" id="periodCancel">Batal</button>
                    <button type="submit" class="period-btn period-btn-primary">Terapkan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        @if($hasData)
            <div class="cards">
                <div class="card">
                    <h3>Total Transaksi</h3>
                    <div class="metric" id="m-total-transaksi">{{ number_format($totalTransaksi) }}</div>
                </div>
                <div class="card">
                    <h3>Total Pendapatan</h3>
                    <div class="metric" id="m-total-pendapatan">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                </div>
                <div class="card">
                    <h3>Total Item Terjual</h3>
                    <div class="metric" id="m-total-item">{{ number_format($totalItemTerjual) }}</div>
                </div>
            </div>
        @else
            <!-- [TAMBAHAN] Pesan error jika tidak ada data -->
            <div class="no-data-message">
                <div class="no-data-icon">📊</div>
                <h3>Tidak Ada Data Transaksi</h3>
                <p>{{ $errorMessage }}</p>
            </div>
        @endif

        @if($hasData)
            <div class="section">
                <div class="section-header">
                    <h3>Top 5 Makanan Terlaris</h3>
                    <span class="periode-label">{{ $periodeDashboard }}</span>
                </div>
                <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kuantitas</th>
                        </tr>
                    </thead>
                    <tbody id="top-food-products-body">
                        </tbody>
                </table>
                </div>
            </div>

            <div class="section">
                <div class="section-header">
                    <h3>Top 5 Minuman Terlaris</h3>
                    <span class="periode-label">{{ $periodeDashboard }}</span>
                </div>
                <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kuantitas</th>
                        </tr>
                    </thead>
                    <tbody id="top-drink-products-body">
                        </tbody>
                </table>
                </div>
            </div>
        @endif
    </div>
@endsection
@push('scripts')
    <script>
        // [TAMBAHAN] JavaScript untuk periode selector
        document.addEventListener('DOMContentLoaded', function() {
            const periodIndicator = document.getElementById('periodIndicator');
            const periodModal = document.getElementById('periodModal');
            const periodModalClose = document.getElementById('periodModalClose');
            const periodCancel = document.getElementById('periodCancel');
            const periodForm = document.getElementById('periodForm');
            const selectedMonth = document.getElementById('selectedMonth');
            const selectedYear = document.getElementById('selectedYear');

            // Set month and year based on URL parameters or current date
            const urlParams = new URLSearchParams(window.location.search);
            const selectedMonthParam = urlParams.get('selected_month');
            const selectedYearParam = urlParams.get('selected_year');

            if (selectedMonthParam && selectedYearParam) {
                selectedMonth.value = selectedMonthParam;
                selectedYear.value = selectedYearParam;
            } else {
                const currentDate = new Date();
                selectedMonth.value = currentDate.getMonth() + 1;
                selectedYear.value = currentDate.getFullYear();
            }

            // Open modal when clicking period indicator
            periodIndicator.addEventListener('click', function() {
                periodModal.classList.add('show');
                document.body.style.overflow = 'hidden'; // Prevent background scroll

                // Focus on first select for better mobile experience
                setTimeout(() => {
                    selectedMonth.focus();
                }, 100);
            });

            // Close modal functions
            function closeModal() {
                periodModal.classList.remove('show');
                document.body.style.overflow = 'auto'; // Restore scroll
            }

            periodModalClose.addEventListener('click', closeModal);
            periodCancel.addEventListener('click', closeModal);

            // Close modal when clicking outside
            periodModal.addEventListener('click', function(e) {
                if (e.target === periodModal) {
                    closeModal();
                }
            });

            // Handle form submission
            periodForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const month = selectedMonth.value;
                const year = selectedYear.value;

                // Create URL with period parameters
                const url = new URL(window.location.href);
                url.searchParams.set('period', 'month');
                url.searchParams.set('selected_month', month);
                url.searchParams.set('selected_year', year);

                // Redirect to dashboard with new period
                window.location.href = url.toString();
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && periodModal.classList.contains('show')) {
                    closeModal();
                }
            });
        });
        // --- KODE JAVASCRIPT ANDA (TIDAK PERLU DIUBAH) ---
        function formatNumber(idn) {
            return new Intl.NumberFormat('id-ID').format(idn);
        }
        function formatRupiah(num) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(num));
        }
        async function refreshDashboard() {
            try {
                // Ambil data ringkasan bulanan (terusan parameter periode dari URL agar tidak override)
                const params = new URLSearchParams(window.location.search);
                const summaryUrl = '/api/v1/dashboard/monthly-summary' + (params.toString() ? ('?' + params.toString()) : '');
                const respSummary = await fetch(summaryUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
                const dataSummary = await respSummary.json();
                if (dataSummary.success) {
                    document.getElementById('m-total-transaksi').textContent = formatNumber(dataSummary.data.total_transactions);
                    document.getElementById('m-total-pendapatan').textContent = formatRupiah(dataSummary.data.total_revenue);
                    document.getElementById('m-total-item').textContent = formatNumber(dataSummary.data.total_items_sold);
                } else {
                    console.error('Error fetching monthly summary:', dataSummary.message);
                }

                // Ambil data top produk
                const productsUrl = '/api/v1/dashboard/top-products' + (params.toString() ? ('?' + params.toString()) : '');
                const respProducts = await fetch(productsUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
                const dataProducts = await respProducts.json();
                if (dataProducts.success) {
                    // Tabel makanan terlaris
                    const foodBody = document.getElementById('top-food-products-body');
                    if (Array.isArray(dataProducts.data.top_food_products) && dataProducts.data.top_food_products.length) {
                        foodBody.innerHTML = dataProducts.data.top_food_products.map(function(row){
                            return '<tr><td>' + row.nama_produk + '</td><td>' + formatNumber(row.total_terjual) + '</td></tr>';
                        }).join('');
                    } else {
                        foodBody.innerHTML = '<tr><td colspan="2" style="text-align:center; color:#64748b">Belum ada data</td></tr>';
                    }

                    // Tabel minuman terlaris
                    const drinkBody = document.getElementById('top-drink-products-body');
                    if (Array.isArray(dataProducts.data.top_drink_products) && dataProducts.data.top_drink_products.length) {
                        drinkBody.innerHTML = dataProducts.data.top_drink_products.map(function(row){
                            return '<tr><td>' + row.nama_produk + '</td><td>' + formatNumber(row.total_terjual) + '</td></tr>';
                        }).join('');
                    } else {
                        drinkBody.innerHTML = '<tr><td colspan="2" style="text-align:center; color:#64748b">Belum ada data</td></tr>';
                    }
                } else {
                    console.error('Error fetching top products:', dataProducts.message);
                }
            } catch (e) {
                console.error('Error:', e);
                const errorHtml = '<tr><td colspan="2" style="text-align:center; color:red">Gagal mengambil data</td></tr>';
                document.getElementById('m-total-transaksi').textContent = 'Error';
                document.getElementById('m-total-pendapatan').textContent = 'Error';
                document.getElementById('m-total-item').textContent = 'Error';
                document.getElementById('top-food-products-body').innerHTML = errorHtml;
                document.getElementById('top-drink-products-body').innerHTML = errorHtml;
            }
        }
        refreshDashboard();
        setInterval(refreshDashboard, 10000);
    </script>
@endpush
