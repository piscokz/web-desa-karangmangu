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
    Schema::create('population_deaths', function (Blueprint $table) {
        $table->id('id_kematian'); // primary key
        $table->unsignedBigInteger('id_penduduk')->unique(); // foreign key + one-to-one
        $table->date('tanggal_kematian');
        $table->timestamps();

        // foreign key constraint ke residents.id_penduduk
        $table->foreign('id_penduduk')->references('id')->on('residents')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('population_deaths');
    }
};
