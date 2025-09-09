<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_transaksi')->unique();
        $table->timestamp('waktu_transaksi');
        $table->unsignedBigInteger('subtotal');
        $table->unsignedBigInteger('ppn_jumlah');
        $table->unsignedBigInteger('grand_total');
        $table->string('metode_pembayaran');
        $table->string('lokasi_meja')->nullable();
        $table->integer('nomor_meja')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
