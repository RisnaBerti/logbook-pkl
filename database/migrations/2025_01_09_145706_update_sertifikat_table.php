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
            $table->dropColumn('sertifikat');

            // Tambahkan kolom sertifikat
            $table->string('sertifikat_depan', 50)->nullable()->after('tanggal_sertifikat');
            $table->string('sertifikat_belakang', 50)->nullable()->after('sertifikat_depan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sertifikat', function (Blueprint $table) {
            // Tambahkan kembali kolom nilai
            $table->string('sertifikat')->nullable();

            // Hapus kolom sertifikat
            $table->dropColumn('sertifikat_depan');
            $table->dropColumn('sertifikat_belakang');
        });
    }
};
