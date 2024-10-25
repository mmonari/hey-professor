<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        //dd($request->question);

        $attributes = $request->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    // check if the question ends with a question mark
                    if ($value[strlen($value) - 1] !== '?') {
                        $fail('The question must end with a question mark.');
                    }
                },
            ],
        ]);

        Question::query()->create($attributes);

        return to_route('dashboard');
    }
}
