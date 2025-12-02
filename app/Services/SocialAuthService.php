<?php

namespace App\Services;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialAuthService
{
    /**
     * Handle the callback from Google.
     *
     * @return User
     * @throws Exception
     */
    public function handleGoogleCallback(): User
    {
        try {
            // Get account of user using socialite
            $socialUser = Socialite::driver('google')->stateless()->user();

            // Find the user in the database
            $user = User::where('google_id', $socialUser->id)->first();

            // If user is found, return it
            if ($user) {
                return $user;
            }

            // If user is not found, create a new one
            return $this->registerGoogleUser($socialUser);

        } catch (Exception $e) {
            throw new Exception('Google login failed: ' . $e->getMessage());
        }
    }

    /**
     * Register a new user from Google data.
     *
     * @param mixed $socialUser
     * @return User
     */
    protected function registerGoogleUser($socialUser): User
    {
        // Get first and last name from Google raw data
        $firstName = $socialUser->user['given_name'] ?? '';
        $lastName = $socialUser->user['family_name'] ?? '';

        // Fallback if raw data is missing
        if (empty($firstName)) {
            $nameParts = explode(' ', $socialUser->name, 2);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
        }

        // Generate a unique username based on display name
        $userName = strtolower(str_replace(' ', '', $socialUser->name)) . rand(1000, 9999);

        return User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'user_name' => $userName,
            'email' => $socialUser->email,
            'google_id' => $socialUser->id,
            'password' => encrypt('123456dummy') // Google does not share your password
        ]);
    }
}
