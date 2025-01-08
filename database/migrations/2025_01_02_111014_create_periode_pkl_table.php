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
        Schema::create('periode_pkl', function (Blueprint $table) {
            $table->uuid('id_periode_pkl')->primary();            
            $table->uuid('id_sekolah');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('durasi_bulan');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('id_sekolah')->references('id_sekolah')->on('sekolah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        // Hapus relasi foreign key sebelum menghapus tabel
        Schema::table('periode_pkl', function (Blueprint $table) {
            $table->dropForeign(['id_sekolah']);
        });

        Schema::dropIfExists('periode_pkl');
    }
};
