<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('perfils')->insert([
            [
                'idUsuario' => 1,
                'nombre' => 'Administrador',
                'descripcion' => 'Perfil con acceso total al sistema',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
