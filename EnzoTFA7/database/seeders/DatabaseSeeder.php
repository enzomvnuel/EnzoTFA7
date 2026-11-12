<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([
            ['full_name' => 'Philline Perez', 'email' => 'philline.perez@example.com', 'phone' => '0917 555 0101', 'created_at' => now(), 'updated_at' => now()],
            ['full_name' => 'Alexa Gallardo', 'email' => 'alexa.gallardo@example.com', 'phone' => '0917 555 0102', 'created_at' => now(), 'updated_at' => now()],
            ['full_name' => 'Eunice Casteñares', 'email' => 'eunice.castenares@example.com', 'phone' => '0917 555 0103', 'created_at' => now(), 'updated_at' => now()],
            ['full_name' => 'Jazmine Mae', 'email' => 'jazmine.mae@example.com', 'phone' => '0917 555 0104', 'created_at' => now(), 'updated_at' => now()],
            ['full_name' => 'Jaeden Mallows', 'email' => 'jaeden.mallows@example.com', 'phone' => '0917 555 0105', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('users')->insert([
            ['username' => 'enzo.reyes', 'full_name' => 'Enzo Reyes', 'created_at' => now(), 'updated_at' => now()],
            ['username' => 'mia.santos', 'full_name' => 'Mia Santos', 'created_at' => now(), 'updated_at' => now()],
            ['username' => 'noah.cruz', 'full_name' => 'Noah Cruz', 'created_at' => now(), 'updated_at' => now()],
            ['username' => 'sofia.garcia', 'full_name' => 'Sofia Garcia', 'created_at' => now(), 'updated_at' => now()],
            ['username' => 'liam.mendoza', 'full_name' => 'Liam Mendoza', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
