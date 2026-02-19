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
    Schema::create('pengaturan_dendas', function (Blueprint $table) {
        $table->id();
        $table->integer('denda_telat_per_hari')->default(10000);
        $table->integer('denda_rusak')->default(50000);
        $table->integer('denda_hilang')->default(250000);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_dendas');
    }
};
