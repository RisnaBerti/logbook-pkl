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
        Schema::table('anak_pkl', function (Blueprint $table) {
            // Tambahkan kolom anak_pkl
            $table->boolean('status')->default(0)->after('foto_anak_pkl');
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anak_pkl', function (Blueprint $table) {
            // Hapus kolom anak_pkl
            $table->dropColumn('status');
        });
    }
};
