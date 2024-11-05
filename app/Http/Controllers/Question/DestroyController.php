<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class DestroyController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {

        Gate::authorize('destroy', $question);

        $question->forceDelete();

        return back();
    }
}
