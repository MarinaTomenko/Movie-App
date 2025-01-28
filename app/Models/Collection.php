<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'collections';

    
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'user_id',
    ];

    // Отношение "многие ко многим" с фильмами
    public function movies()
    {
        print_r('movies');
        return $this->belongsToMany(Movie::class);
    }
}