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
        Schema::table('riwayat_mentoring', function (Blueprint $table) {
            // Hapus foreign key constraints
            // $table->dropForeign(['id_anak_pkl']);
            // $table->dropForeign(['id_mentor']);
            // Hapus kolom nilai
            $table->dropColumn('id_anak_pkl');
            $table->dropColumn('id_mentor');
            $table->dropColumn('hari_mentor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_mentoring', function (Blueprint $table) {
            // Tambahkan kembali kolom nilai
            $table->uuid('id_anak_pkl')->nullable();
            $table->uuid('id_mentor')->nullable();
            $table->integer('hari_mentor')->nullable();

            // Tambahkan kembali foreign key constraints
            // $table->foreign('id_anak_pkl')->references('id_anak_pkl')->on('anak_pkl')->onDelete('cascade');
            // $table->foreign('id_mentor')->references('id_mentor')->on('mentors')->onDelete('cascade');
        });
    }
};
