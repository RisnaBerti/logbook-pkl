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
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->uuid('id_sertifikat')->primary();
            $table->uuid('id_anak_pkl');
            $table->string('judul_sertifikat');
            $table->string('nama_pengesah');
            $table->date('tanggal_sertifikat');
            $table->string('keterangan', 100);
            $table->timestamps();

            $table->foreign('id_anak_pkl')->references('id_anak_pkl')->on('anak_pkl')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sertifikat', function (Blueprint $table) {
            $table->dropForeign(['id_anak_pkl']);
        });

        Schema::dropIfExists('sertifikat');
    }
};
