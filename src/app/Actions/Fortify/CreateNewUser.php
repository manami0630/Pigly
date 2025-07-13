<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class CreateNewUser implements CreatesNewUsers
{
    public function create(array $input)
    {
        $request = new RegisterRequest();
        $request->merge($input);

        $validated = app()->make(RegisterRequest::class);
        $validated->merge($input);
        app()->validator->validate($validated->all(), $validated->rules(), $validated->messages());

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        Auth::login($user);

        return $user;
    }
}
