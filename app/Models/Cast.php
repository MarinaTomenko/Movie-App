<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cast extends Model
{
    use HasFactory;

    protected $table = 'movie_person'; 


    protected $fillable = [
        'movie_id',
        'person_id',
        'character_name',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_person', 'person_id', 'movie_id')
                    ->withPivot('character_name');
    }
    public function persons()
    {
        return $this->belongsToMany(Person::class, 'people', 'movie_id', 'person_id');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

}
