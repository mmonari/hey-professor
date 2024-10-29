<?php

use App\Models\User;

if (!function_exists('user')) {
    /**
     * Get the currently authenticated user.
     *
     * @return App\Models\User|null
     */
    function user(): ?User
    {
        if (auth()->check()) {
            return auth()->user();
        }

        return null;
    }
}
