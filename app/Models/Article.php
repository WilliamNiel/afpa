<?php

namespace App\Models;

use App\Models\Etat;
use App\Models\Visibilite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function articles(){
        return $this->all();
    }

    public function article($id)
    {
        return $this->findOrFail($id);
    }

    public function visibilite()
    {
        return $this->belongsTo(Visibilite::class);
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }
}
