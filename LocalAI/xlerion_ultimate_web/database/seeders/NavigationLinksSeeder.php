<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class NavigationLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('navigation_links')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('navigation_links')->insert([
            [
                'name' => 'Inicio',
                'route' => '/',
                'order' => 1,
                'icon_class' => 'fa-solid fa-house',
            ],
            [
                'name' => 'Filosofía',
                'route' => '/filosofia',
                'order' => 2,
                'icon_class' => 'fa-solid fa-lightbulb',
            ],
            [
                'name' => 'Soluciones',
                'route' => '/soluciones',
                'order' => 3,
                'icon_class' => 'fa-solid fa-layer-group',
            ],
            [
                'name' => 'Proyectos',
                'route' => '/proyectos',
                'order' => 4,
                'icon_class' => 'fa-solid fa-briefcase',
            ],
            [
                'name' => 'Documentación',
                'route' => '/documentacion',
                'order' => 5,
                'icon_class' => 'fa-solid fa-book-open',
            ],
            [
                'name' => 'Fundador',
                'route' => '/fundador',
                'order' => 6,
                'icon_class' => 'fa-solid fa-user-tie',
            ],
            [
                'name' => 'Blog',
                'route' => '/blog',
                'order' => 7,
                'icon_class' => 'fa-solid fa-newspaper',
            ],
            [
                'name' => 'Contacto',
                'route' => '/contacto',
                'order' => 8,
                'icon_class' => 'fa-solid fa-envelope',
            ],
        ]);
    }
}
