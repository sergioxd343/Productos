<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Admin',
                'usuario' => 'admin',
                'hash' => '$2y$12$BKYaezMDsYm120xaRsEH7upGhGLSyzaBCiAint07QjREn2ezLG47K',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
