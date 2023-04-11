<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Article;
class Calendar extends Component
{
    public $articles = [];

    public function mount()
    {
        $this->getEvents();
    }

    public function getEvents()
    {
        $articles = Article::where('etat_id', 2)->get();

        $this->articles = $articles->map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->titre,
                'start' => $article->date_debut,
                'end' => $article->date_fin,
            ];
        });
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}