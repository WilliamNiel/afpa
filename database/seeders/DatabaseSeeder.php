<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Visibilite;
use App\Models\Etat;
use App\Models\Article;
use App\Models\News;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $visibilites = Visibilite::factory(3)->create();
        $etats = Etat::factory(3)->create();

        Article::factory(10)->create()->each(function ($article) use ($visibilites, $etats) {
            $article->visibilite()->associate($visibilites->random());
            $article->etat()->associate($etats->random());
            $article->save();
        });

        News::factory(10)->create()->each(function ($new) use ($visibilites, $etats) {
            $new->visibilite()->associate($visibilites->random());
            $new->etat()->associate($etats->random());
            $new->save();
        });
    }
}
