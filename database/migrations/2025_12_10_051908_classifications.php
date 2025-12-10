<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel submissions
            $table->foreignId('submission_id')->constrained('submissions')->onDelete('cascade');

            // Simpan hasil prediksi
            $table->enum('prediksi_status', ['Diterima', 'Ditolak']);

            // Simpan nilai probabilitas (skor) untuk analisa
            $table->float('probabilitas_diterima')->default(0);
            $table->float('probabilitas_ditolak')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classifications');
    }
};
