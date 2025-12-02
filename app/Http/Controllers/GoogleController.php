<?php

namespace App\Http\Controllers;

use App\Services\SocialAuthService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function googlePage()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function googleCallBack(SocialAuthService $socialAuthService)
    {
        try {
            $user = $socialAuthService->handleGoogleCallback();

            return $this->_loginOr2FA($user);

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    protected function _loginOr2FA($user)
    {
        // Check if user has 2FA enabled
        // The TwoFactorAuthenticatable trait provides 'two_factor_secret'
        if ($user->two_factor_secret) {
            // Store user ID in session for Fortify to pick up
            session(['login.id' => $user->id]);
            session(['login.remember' => true]); // Default to remember for social login

            return redirect()->route('two-factor.login');
        }

        Auth::login($user, true);
        return redirect()->intended('dashboard');
    }
}
