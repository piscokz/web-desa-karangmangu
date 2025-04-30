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
        Schema::create('family_cards', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk', 16)->unique();
            $table->unsignedBigInteger('id_rt');
            $table->unsignedBigInteger('id_rw');
            $table->unsignedBigInteger('id_dusun');
            $table->foreign('id_rt')->references('id')->on('rts')->onDelete('cascade');
            $table->foreign('id_rw')->references('id')->on('rws')->onDelete('cascade');
            $table->foreign('id_dusun')->references('id')->on('hamlets')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_cards');
    }
};
