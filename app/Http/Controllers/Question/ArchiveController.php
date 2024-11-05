<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class ArchiveController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {

        Gate::authorize('archive', $question);

        $question->delete();

        return back();
    }
}
