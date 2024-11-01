<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EditController extends Controller
{
    public function edit(Question $question): View
    {
        return view('question.edit', ['question' => $question]);
    }

    public function update(Question $question): RedirectResponse
    {
        $question->update(request()->validate([
            'question' => 'required',
        ]));

        return back();
    }
}
