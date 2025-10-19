## Kasir Web

Aplikasi laporan transaksi untuk kasir, terintegrasi dengan [Aplikasi Kasir - Gulai Kambiang Kakek](https://github.com/IamDoctrin/kasir_android)


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

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
