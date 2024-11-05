<?php

namespace App\Http\Controllers\Auth\Github;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class CallbackController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): RedirectResponse
    {
        $ghUser = Socialite::driver('github')->user();

        $oAuthUser = User::query()
            ->updateOrCreate(
                ['email' => $ghUser->getEmail()],
                ['name' => $ghUser->getName(), 'password' => Str::random(64), 'email_verified_at' => now()]
            );

        Auth::login($oAuthUser);

        return to_route('dashboard');

    }
}
