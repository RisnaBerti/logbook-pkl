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
        Schema::create('riwayat_mentoring', function (Blueprint $table) {
            $table->uuid('id_riwayat_mentoring')->primary();
            $table->uuid('id_anak_pkl');
            $table->uuid('id_mentor');
            $table->date('tanggal_mulai'); // Date column: tanggal_mulai
            $table->date('tanggal_akhir'); // Date column: tanggal_akhir
            $table->integer('hari_mentor');
            $table->timestamps();

            $table->foreign('id_anak_pkl')->references('id_anak_pkl')->on('anak_pkl')->onDelete('cascade');
            $table->foreign('id_mentor')->references('id_mentor')->on('mentor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Hapus relasi foreign key sebelum menghapus tabel
         Schema::table('riwayat_mentoring', function (Blueprint $table) {
            $table->dropForeign(['id_anak_pkl']);
            $table->dropForeign(['id_mentor']);
        });
        Schema::dropIfExists('riwayat_mentoring');
    }
};
