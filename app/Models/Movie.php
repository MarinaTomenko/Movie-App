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

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function apiRequest()
    {
        return $this->hasOne(MovieApiRequest::class, 'movie_id');
    }

    public function collections()
    {
        return $this->belongsToMany(MovieList::class, 'collection_movie');
    }

    public function people()
    {
        return $this->belongsToMany(Person::class);
    }

    public function movieCasts()
    {
        return $this->hasMany(Cast::class);
    }

    
    public function movieCrews()
    {
        return $this->hasMany(Crew::class); 
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

}
