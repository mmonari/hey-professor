<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Rules\{QuestionMarkRule};
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

        if ($question->question !== request('question')) {

            request()->validate([
                'question' => [
                    'required',
                    'min:10',
                    new QuestionMarkRule(),
                ],
            ]);

            $question->update(['question' => request('question'), ]);
        }

        return to_route('question.index');
    }
}
