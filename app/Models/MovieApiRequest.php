<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieApiRequest extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movie_api_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movie_id',
        'status',
        'json_response',
        'image_path',
    ];

    /**
     * Get the movie associated with the request.
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}