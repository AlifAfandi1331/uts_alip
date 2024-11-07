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
        schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('no_pasien');
            $table->string('nama');
            $table->string('umur');
            $table->enum('jenis_kelamin', ['perempuan', 'laki-laki']);
            $table->string('alamat')->nullable();
            $table->string('nomor_telepon_pasien');
            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};