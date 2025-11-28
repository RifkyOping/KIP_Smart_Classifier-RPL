<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Prompts\Table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->String('nama');
            $table->String('nim');
            $table->String('fakultas');
            $table->String('prodi');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->String('no_telepon');
            $table->integer('semester');
            $table->String('angkatan');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
