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
        Schema::table('penilaian', function (Blueprint $table) {
            // Hapus foreign key jika ada
            $table->dropForeign(['id_keterampilan']); // Nama foreign key default Laravel
            $table->dropColumn('id_keterampilan'); // Hapus kolom

            // Hapus kolom nilai
            $table->dropColumn('nilai');

            // Tambahkan kolom nilai_rata_rata
            $table->float('nilai_rata_rata', 5, 2)->nullable()->after('tanggal_penilaian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {
            // Tambahkan kembali kolom id_keterampilan
            $table->unsignedBigInteger('id_keterampilan')->nullable();

            // Tambahkan foreign key kembali
            $table->foreign('id_keterampilan')->references('id_keterampilan')->on('keterampilan')->onDelete('cascade');

            // Tambahkan kembali kolom nilai
            $table->float('nilai', 5, 2)->nullable();

            // Hapus kolom nilai_rata_rata
            $table->dropColumn('nilai_rata_rata');
        });
    }
};
