<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
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

    public function googleCallBack()
    {
        try {

            // Get account of user using socialite
            $user = Socialite::driver('google')->stateless()->user();

            // Find the user in the database
            $finduser = User::where('google_id', $user->id)->first();

            // If user is found, log them
            if ($finduser) {
                return $this->_loginOr2FA($finduser);
            }

            // If user is not found, add the user to user table
            else {
                // Get first and last name from Google raw data
                $firstName = $user->user['given_name'] ?? '';
                $lastName = $user->user['family_name'] ?? '';

                // Fallback if raw data is missing (unlikely for Google)
                if (empty($firstName)) {
                    $nameParts = explode(' ', $user->name, 2);
                    $firstName = $nameParts[0];
                    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
                }

                // Generate a unique username based on display name
                $userName = strtolower(str_replace(' ', '', $user->name)) . rand(1000, 9999);

                $newUser = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'user_name' => $userName,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy') // Google does not share your password
                ]);

                return $this->_loginOr2FA($newUser);
            }

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
