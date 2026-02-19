<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanDendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    \App\Models\PengaturanDenda::create([
        'denda_telat_per_hari' => 10000,
        'denda_rusak'          => 50000,
        'denda_hilang'         => 250000,
    ]);
}
}
