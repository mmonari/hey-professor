<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'questions' => Question::query()
                ->where('draft', false)
                ->withSum('votes', 'likes')
                ->withSum('votes', 'dislikes')
                ->orderByRaw('
                    case when votes_sum_likes is null then 0 else votes_sum_likes end desc,
                    case when votes_sum_dislikes is null then 0 else votes_sum_dislikes end
                ')
                ->paginate(5),
        ]);
    }
}
