<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear las categorías de forma segura
        $categories = [
            ['name' => 'Suites', 'slug' => 'suites'],
            ['name' => 'Ejecutivas', 'slug' => 'ejecutivas'],
            ['name' => 'Presidential', 'slug' => 'presidential'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']], // Busca por el slug único
                ['name' => $category['name']]  // Si no existe, lo crea con este nombre
            );
        }

        // Crear el usuario de prueba de forma segura (sin duplicar)
        User::firstOrCreate(
            ['email' => 'databaseAdmin@gmail.com'], // Tu correo maestro
            [
                'name' => 'admin',
                'password' => Hash::Make('databse123'), // Cambia esto por tu contraseña
                'is_admin' => true, // Único administrador
            ]
        );
    }
}
