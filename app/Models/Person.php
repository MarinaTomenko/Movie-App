<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Person extends Model
{
    use HasFactory;
    protected $table = 'people'; 

    protected $fillable = [
        'name',

    ];


    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movies_genres', 'movie_id', 'genre_id');
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function movieCasts()
    {
        return $this->hasMany(Cast::class)->with(Person::class);
    }

    public function movieCrews()
    {
        return $this->hasMany(Crew::class)->with(Person::class);
    }
}
