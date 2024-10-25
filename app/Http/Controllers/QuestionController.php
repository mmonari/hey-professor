<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Question;


class QuestionController extends Controller
{

    public function store(Request $request): RedirectResponse
    {
        //dd($request->question);

        $attributes = $request->validate([
            'question' => ['required']
        ]);

        Question::query()->create([
            $attributes
        ]);

        return redirect(route('dashboard'));
    }
}
