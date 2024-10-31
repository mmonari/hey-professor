<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Closure;
use Illuminate\Http\{RedirectResponse, Request};

class StoreController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {

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

        user()->questions()->create([
            'question' => $attributes['question'],
            'draft'    => true,
        ]);

        return to_route('dashboard');
    }
}
