<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Department extends Model
{
    use HasFactory;

    protected $table = 'departments'; 

    protected $fillable = [
        'name',

    ];
    public function crews()
    {
        return $this->HasMany(Crew::class);
    }



    /*
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movies_genres', 'genre_id', 'movie_id');
    } */

}
