<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function likes(Question $question): void
    {
        $this->votes()->updateOrCreate(
            ['question_id' => $question->id],
            [
                'likes'    => 1,
                'dislikes' => 0,
            ]
        );
    }

    public function dislikes(Question $question): void
    {
        $this->votes()->updateOrCreate(
            ['question_id' => $question->id],
            [
                'likes'    => 0,
                'dislikes' => 1,
            ]
        );
    }

    /**
     * @return HasMany<Vote>
    */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'user_id', 'id');
    }

    /**
     * @return HasMany<Question>
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'created_by', 'id');
    }
}
