<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class EditController extends Controller
{
    public function edit(Question $question): View
    {
        Gate::authorize('update', $question);

        return view('question.edit', ['question' => $question]);
    }

    public function update(Question $question): RedirectResponse
    {
        Gate::authorize('update', $question);

        request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] !== '?') {
                        $fail('The question must end with a question mark.');
                    }
                },
            ],
        ]);

        if ($question->question !== request('question')) {
            $question->update(['question' => request('question'), ]);
        }

        return to_route('question.index');
    }
}
