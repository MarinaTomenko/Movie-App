<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Movie extends Model
{
    use HasFactory;
    protected $table = 'movies'; 

    protected $fillable = [
        'title',
        'release_date',
        'overview',
    ];

 /*
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movies_genres', 'movie_id', 'genre_id');
    }
*/
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movies_genres', 'movie_id', 'genre_id');
    }

    public function apiRequest()
    {
        return $this->hasOne(MovieApiRequest::class, 'movie_id');
    }

    public function collections()
    {
        return $this->belongsToMany(MovieList::class, 'collection_movie');
    }
}
