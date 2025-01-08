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
        Schema::create('anak_pkl', function (Blueprint $table) {
            $table->uuid('id_anak_pkl')->primary();
            $table->uuid('id_sekolah');
            $table->uuid('id_periode_pkl');
            $table->uuid('id_mentor');
            $table->string('nama_anak_pkl', 100);
            $table->string('no_telp_anak_pkl', 100);
            $table->string('email_anak_pkl', 100);
            $table->string('foto_anak_pkl')->nullable();
            $table->timestamps();
            //foreign dengan tabel sekolah, periode_pkl, mentor
            // Relasi foreign key
            $table->foreign('id_sekolah')->references('id_sekolah')->on('sekolah')->onDelete('cascade');
            $table->foreign('id_periode_pkl')->references('id_periode_pkl')->on('periode_pkl')->onDelete('cascade');
            $table->foreign('id_mentor')->references('id_mentor')->on('mentor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus relasi foreign key sebelum menghapus tabel
        Schema::table('anak_pkl', function (Blueprint $table) {
            $table->dropForeign(['id_sekolah']);
            $table->dropForeign(['id_periode_pkl']);
            $table->dropForeign(['id_mentor']);
        });

        Schema::dropIfExists('anak_pkl');
    }
};
