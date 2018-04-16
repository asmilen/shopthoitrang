<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\AuthenticationException;
use Sentinel;
use Socialite;
use App\Models\User;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Socialite provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Socialite provider.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = Sentinel::findByCredentials(['email' => $googleUser->email]);

        if (! $user) {
            return redirect('/');
        }

        Sentinel::login($user);

        return redirect('/quantri');
    }
}