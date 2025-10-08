<?php

namespace App\Repositories\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserProfileResource;
use App\Mail\Welcome;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegisterRepository
{
    /**
     * Create a new user account.
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'lang' => $request->input('lang', 'fr'),
            'role' => 'user',
            'signup_method' => $request->input('signup_method', 'email'),
            'status' => true,
            'terms_accepted_at' => now(),
        ]);

        try {
            Mail::to($user->email)->send(new Welcome($user));
        } catch (\Throwable $e) {
            Log::error("Erreur lors de l'envoi de l'email de bienvenue", [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);
        }

        return new UserProfileResource($user);
    }
}
