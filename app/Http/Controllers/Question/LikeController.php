<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\{Question, Vote};
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Question $question): RedirectResponse
    {
        Vote::query()->create([
            'question_id' => $question->id,
            'user_id'     => auth()->user()->id,
            'likes'       => 1,
            'dislikes'    => 0,
        ]);

        return to_route('dashboard');
    }
}
