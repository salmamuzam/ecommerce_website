<?php

namespace App\Http\Requests;

use App\Models\User;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class LoginRequest extends FortifyLoginRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules();
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $login = $this->input('login');

        $user = User::where('email', $login)
            ->orWhere('user_name', $login)
            ->first();

        if ($user) {
            $this->merge([
                'email' => $user->email,
            ]);
        }
    }
}
