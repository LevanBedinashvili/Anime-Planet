<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected string $table = 'users';

    protected array $fillable = [
        'username',
        'email',
        'password_hash',
        'role'
    ];

    public function animeLists(): array
    {
        return $this->hasMany(UserAnimeList::class, 'user_id');
    }
}
