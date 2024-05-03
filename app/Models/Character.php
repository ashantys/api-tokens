<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'serie_id', 'image_url', 'description'];

    public function moviesOrSeries()
    {
        return $this->belongsToMany(Serie::class);
    }
}
