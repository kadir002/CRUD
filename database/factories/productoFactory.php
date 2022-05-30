<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\producto>
 */
class productoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre'=>"nike",
            "img"=>"http://127.0.0.1:8000/storage/productoImagen/viCPfAHYXC.jpg",
            "categoria"=>"zapatos",
            "descripcion"=>"poliester",
            "precio"=>20.00,
            "inventario"=>0
        ];
    }
}
