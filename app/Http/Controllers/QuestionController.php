<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        //dd($request->question);

        $attributes = $request->validate([
            'question' => ['required', 'min:10'],
        ]);

        Question::query()->create($attributes);

        return to_route('dashboard');
    }
}
