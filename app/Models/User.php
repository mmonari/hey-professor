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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function likes(Question $question): Vote
    {
        return Vote::query()->create([
            'question_id' => $question->id,
            'user_id'     => $this->id,
            'likes'       => 1,
            'dislikes'    => 0,
        ]);
    }

    public function dislikes(Question $question): Vote
    {
        return Vote::query()->create([
            'question_id' => $question->id,
            'user_id'     => $this->id,
            'likes'       => 0,
            'dislikes'    => 1,
        ]);
    }

    /**
     * @return HasMany<Vote>
    */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'user_id', 'id');
    }
}
