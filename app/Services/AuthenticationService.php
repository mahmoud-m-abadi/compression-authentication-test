<?php

namespace App\Services;

use Laravel\Socialite\Facades\Socialite;

class AuthenticationService
{
    public function __construct() {}

    /**
     */
    public function login()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     */
    public function callback()
    {
        $user = Socialite::driver('google')->user();

        // TODO: Save User INFO in DB

        return $user->getEmail();
    }
}
