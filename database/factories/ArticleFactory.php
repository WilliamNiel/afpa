<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titre' => $this->faker->sentence(rand(5, 10), true),
            'date_debut' => $this->faker->date(),
            'date_fin' => $this->faker->date(),
            'sujet' => $this->faker->sentence(rand(5, 10), true),
            'image' => 'https://via.placeholder.com/1000',
            'contenu' => $this->faker->sentence(5, true),
            'visibilite_id' => DB::table('visibilites')->inRandomOrder()->first()->id,
            'etat_id' => DB::table('etats')->inRandomOrder()->first()->id,
        ];
    }
}
