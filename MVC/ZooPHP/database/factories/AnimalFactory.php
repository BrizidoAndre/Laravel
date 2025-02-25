<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => 'Lobo-cinzento',
            'nome_cientifico' => 'Canis lupus',
            'altura' => '80 - 85 cm (Adulto, até ao ombro)',
            'comprimento' => '1 - 1,6 m (Adulto)',
            'peso' => '30 - 80 kg (Macho, Adulto), 23 - 55 kg (Fêmea, Adulto)',
            'expectativa_vida' => '16 anos (Macho, em cativeiro), 14 anos (Fêmea, na natureza)',
            'id_classe' => 1,
            'id_alimentacao' => 1
        ];
    }
}
