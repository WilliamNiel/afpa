<?php

namespace App\Models;

use App\Models\Etat;
use App\Models\Visibilite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function visibilite()
    {
        return $this->belongsTo(Visibilite::class);
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }
}
