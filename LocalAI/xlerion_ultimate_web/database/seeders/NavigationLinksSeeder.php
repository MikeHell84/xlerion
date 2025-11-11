<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavigationLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('navigation_links')->insert([
            [
                'name' => 'Inicio',
                'route' => '/',
                'order' => 1,
            ],
            [
                'name' => 'Filosofía',
                'route' => '/filosofia',
                'order' => 2,
            ],
            [
                'name' => 'Soluciones',
                'route' => '/soluciones',
                'order' => 3,
            ],
            [
                'name' => 'Proyectos',
                'route' => '/proyectos',
                'order' => 4,
            ],
            [
                'name' => 'Documentación',
                'route' => '/documentacion',
                'order' => 5,
            ],
            [
                'name' => 'Fundador',
                'route' => '/fundador',
                'order' => 6,
            ],
            [
                'name' => 'Convocatorias',
                'route' => '/convocatorias',
                'order' => 7,
            ],
            [
                'name' => 'Blog',
                'route' => '/blog',
                'order' => 8,
            ],
            [
                'name' => 'Contacto',
                'route' => '/contacto',
                'order' => 9,
            ],
        ]);
    }
}
