<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class AuthRedirectController extends Controller
{
    public function __invoke(string $service)
    {
        return Socialite::driver($service)->redirect();
    }
}
