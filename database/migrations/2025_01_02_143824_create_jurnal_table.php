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
        Schema::create('jurnal', function (Blueprint $table) {
            $table->uuid('id_jurnal')->primary();
            $table->uuid('id_anak_pkl');
            $table->uuid('id_mentor');
            $table->string('aktifitas');
            $table->date('tanggal_jurnal');
            $table->timestamp('waktu_mulai_aktifitas');
            $table->timestamp('waktu_selesai_aktifitas');
            $table->integer('durasi');
            $table->string('keterangan');

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
        Schema::table('sertifikat', function (Blueprint $table) {
            $table->dropForeign(['id_anak_pkl']);
            $table->dropForeign(['id_mentor']);
        });
        Schema::dropIfExists('jurnal');
    }
};
