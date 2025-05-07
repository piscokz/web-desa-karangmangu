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
    Schema::create('village_contacts', function (Blueprint $table) {
        $table->id(); // primary key custom
        $table->string('no_telepon')->nullable();
        $table->string('email')->nullable();
        $table->string('instagram')->nullable();
        $table->string('youtube')->nullable();
        $table->string('facebook')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_contacts');
    }
};
