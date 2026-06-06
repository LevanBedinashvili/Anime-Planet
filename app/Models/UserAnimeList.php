<?php

namespace App\Models;

use Core\Model;

class UserAnimeList extends Model
{
    protected string $table = 'user_anime_lists';

    protected array $fillable = [
        'user_id',
        'jikan_anime_id',
        'status',
        'score'
    ];

    public function user(): ?Model
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
