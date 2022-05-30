<?php

namespace Database\Seeders;

use App\Models\producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        producto::factory()->create([
            'nombre'=>"nike",
            "img"=>"http://127.0.0.1:8000/storage/productoImagen/viCPfAHYXC.jpg",
            "categoria"=>"zapatos",
            "descripcion"=>"poliester",
            "precio"=>20.00,
            "inventario"=>0
        ]);
        producto::factory()->create([
            'nombre'=>"sueter azul",
            "img"=>"http://127.0.0.1:8000/storage/productoImagen/XgDHhHP3yB.jpg",
            "categoria"=>"sueter de hombre",
            "descripcion"=>"sueter color azul",
            "precio"=>20.00,
            "inventario"=>4
        ]);

        producto::factory()->create([
            'nombre'=>"nike",
            "img"=>"http://127.0.0.1:8000/storage/productoImagen/viCPfAHYXC.jpg",
            "categoria"=>"zapatos",
            "descripcion"=>"nike color azul",
            "precio"=>90.00,
            "inventario"=>30
        ]);
        
    }
}
