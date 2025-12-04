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
        if (!Schema::hasTable('menu_unggulan')) {
            Schema::create('menu_unggulan', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->text('deskripsi');
                $table->string('gambar')->nullable();
                $table->integer('urutan')->default(1); // 1 = top-left, 2 = bottom-right
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_unggulan');
    }
};
