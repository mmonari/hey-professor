<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Rules\{QuestionExistsRule, QuestionMarkRule};

use Illuminate\Http\{RedirectResponse, Request};

class StoreController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {

        $attributes = $request->validate([
            'question' => [
                'required',
                'min:10',
                new QuestionMarkRule(),
                new QuestionExistsRule(),
            ],
        ]);

        user()->questions()->create([
            'question' => $attributes['question'],
            'draft'    => true,
        ]);

        return back();
    }
}
