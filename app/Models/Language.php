<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Language extends Model
{
    use HasFactory;

    protected $table = 'languages'; 

    protected $fillable = [
        'code',
        'name',

    ];
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }



    /*
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movies_genres', 'genre_id', 'movie_id');
    } */

}
