<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class ArchiveController extends Controller
{
    public function archive(Question $question): RedirectResponse
    {

        Gate::authorize('archive', $question);

        $question->delete();

        return back();
    }

    public function restore(int $id): RedirectResponse
    {
        $question = Question::onlyTrashed()->findOrFail($id);

        Gate::authorize('restore', $question);

        $question->restore();

        return back();
    }
}
