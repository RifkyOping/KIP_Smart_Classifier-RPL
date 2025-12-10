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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim');
            $table->string('prodi');
            $table->string('fakultas');
            $table->string('semester');
            $table->string('angkatan');
            $table->decimal('ipk');
            $table->string('kip');
            $table->string('pendapatan');
            $table->integer('tanggungan');
            $table->string('transkrip');
            $table->string('sktm')->nullable();
            $table->string('prestasi')->nullable();
            $table->string('bukti_prestasi')->nullable();
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak'])->default('Menunggu');
            $table->foreignId('mahasiswas_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('submissions');
    }
};
