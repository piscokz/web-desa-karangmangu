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
    Schema::create('village_stalls', function (Blueprint $table) {
        $table->id('id_produk'); // primary key
        $table->string('nama_produk');
        $table->unsignedBigInteger('id_penduduk'); // foreign key ke Resident
        $table->string('no_telepon');
        $table->string('gambar_produk');
        $table->text('deskripsi');
        $table->timestamps();

        // foreign key constraint
        $table->foreign('id_penduduk')->references('id')->on('residents')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_stalls');
    }
};
