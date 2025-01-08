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
        Schema::create('sekolah', function (Blueprint $table) {
            $table->uuid('id_sekolah')->primary();
            $table->string('nama_sekolah', 100);
            $table->string('alamat_sekolah', 150);
            $table->string('telepon_sekolah', 20);
            $table->string('email_sekolah', 50);
            $table->string('logo_sekolah')->nullable();
            $table->boolean('status');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah');
    }
};
