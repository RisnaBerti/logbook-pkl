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
        Schema::table('sertifikat', function (Blueprint $table) {
            // Hapus kolom nilai
            $table->dropColumn('judul_sertifikat');
            $table->dropColumn('nama_pengesah');

            // Tambahkan kolom sertifikat
            $table->string('sertifikat', 50)->nullable()->after('tanggal_sertifikat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sertifikat', function (Blueprint $table) {
            // Tambahkan kembali kolom nilai
            $table->string('judul_sertifikat')->nullable();
            $table->string('nama_pengesah')->nullable();

            // Hapus kolom sertifikat
            $table->dropColumn('sertifikat');
        });
    }
};
