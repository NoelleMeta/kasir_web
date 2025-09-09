<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Kasir Web

Aplikasi laporan transaksi untuk kasir, terintegrasi dengan aplikasi Flutter.

### Fitur
- Dashboard metrik: total transaksi, pendapatan, item terjual, top-5 produk.
- Laporan Ringkas dan Detail.
- Filter periode: Hari ini, Minggu ini, Bulan ini, dan Rentang Tanggal.
- Auto-apply filter dan auto-refresh list (polling 10 detik).
- Export Excel dan PDF mengikuti filter aktif.
- Nama file export menyertakan timestamp unduhan.
- Styling export: Excel autosize + border + format angka, pewarnaan selang-seling per transaksi; PDF layout rapi dengan harga rata kanan.

### Endpoints Web
- `/dashboard`
- `/laporan/ringkas`
- `/laporan/detail`
- Export: `/laporan/ringkas/excel|pdf`, `/laporan/detail/excel|pdf`

### API
- `POST /api/v1/transaksi` — menyimpan transaksi beserta itemnya.

Contoh payload:
```json
{
  "nomorTransaksi": "TRX09092501",
  "waktuTransaksi": "2025-09-09 12:34:00",
  "subtotal": 100000,
  "ppnJumlah": 10000,
  "grandTotal": 110000,
  "metodePembayaran": "Cash",
  "lokasiMeja": "Lantai 1",
  "nomorMeja": "A1",
  "items": [
    { "namaProduk": "Ayam Goreng + Nasi", "kuantitas": 1, "hargaSatuan": 25000 },
    { "namaProduk": "Es Teh", "kuantitas": 1, "hargaSatuan": 5000 }
  ]
}
```

### Instalasi Cepat
```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Jika menggunakan Laragon, pastikan base URL yang dipakai Flutter sesuai domain/port Laragon.

## Learning Laravel

Butuh referensi framework? Lihat [Dokumentasi Laravel](https://laravel.com/docs) atau [Laracasts](https://laracasts.com).

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Saran/kontribusi dipersilakan. Ikuti panduan kontribusi di [docs Laravel](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
