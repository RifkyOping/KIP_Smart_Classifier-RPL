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
            $table->integer('penghasilan_orangtua');
            $table->integer('jumlah_tanggungan');
            $table->integer('no_akunkip');
            $table->date('tanggal');
            $table->String('prestasi');
            $table->String('sktm');
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak'])->default('Menunggu');
            $table->foreignId('mahasiswas_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};
