<?php

namespace App\Data;

final class POSData
{
    public static function customers(): array
    {
        return [
            ['id' => 1, 'full_name' => 'Philline Perez', 'email' => 'philline.perez@example.com', 'phone' => '0917 555 0101'],
            ['id' => 2, 'full_name' => 'Alexa Gallardo', 'email' => 'alexa.gallardo@example.com', 'phone' => '0917 555 0102'],
            ['id' => 3, 'full_name' => 'Eunice Casteñares', 'email' => 'eunice.castenares@example.com', 'phone' => '0917 555 0103'],
            ['id' => 4, 'full_name' => 'Jazmine Mae', 'email' => 'jazmine.mae@example.com', 'phone' => '0917 555 0104'],
            ['id' => 5, 'full_name' => 'Jaeden Mallows', 'email' => 'jaeden.mallows@example.com', 'phone' => '0917 555 0105'],
        ];
    }

    public static function users(): array
    {
        return [
            ['id' => 1, 'username' => 'enzo.reyes', 'full_name' => 'Enzo Reyes'],
            ['id' => 2, 'username' => 'mia.santos', 'full_name' => 'Mia Santos'],
            ['id' => 3, 'username' => 'noah.cruz', 'full_name' => 'Noah Cruz'],
            ['id' => 4, 'username' => 'sofia.garcia', 'full_name' => 'Sofia Garcia'],
            ['id' => 5, 'username' => 'liam.mendoza', 'full_name' => 'Liam Mendoza'],
        ];
    }
}
