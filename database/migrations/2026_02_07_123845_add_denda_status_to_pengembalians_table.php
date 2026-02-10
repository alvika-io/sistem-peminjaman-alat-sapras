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
    Schema::table('pengembalians', function (Blueprint $table) {
        $table->enum('denda_status', ['belum_dibayar', 'lunas'])
              ->default('belum_dibayar')
              ->after('denda');
    });
}

public function down(): void
{
    Schema::table('pengembalians', function (Blueprint $table) {
        $table->dropColumn('denda_status');
    });
}

};
