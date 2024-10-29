<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    /**
     *
     * @return HasMany<Vote>
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function getTotalLikesAttribute(): int
    {
        return $this->votes()
                    ->where('likes', 1)
                    ->where('dislikes', 0)
                    ->count();
    }

    public function getTotalDislikesAttribute(): int
    {
        return $this->votes()
                    ->where('likes', 0)
                    ->where('dislikes', 1)
                    ->count();
    }

}
