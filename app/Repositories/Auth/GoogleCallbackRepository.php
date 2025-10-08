<?php

namespace App\Repositories\Auth;

use App\Http\Resources\Auth\UserProfileResource;
use App\Mail\Welcome;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class GoogleCallbackRepository
{

    /**
     * Handle Google OAuth callback and log in an existing user
     */
    public function loginWithGoogle(): ?User
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if (! $user) {
            abort(Response::HTTP_UNAUTHORIZED, __('app/auth/common.google.account_not_found'));
        }

        if (! $user->google_id) {
            $user->update([
                'google_id' => $googleUser->getId(),
            ]);
        }

        $user->update([
            'last_login_at' => now(),
        ]);

        Auth::guard('web')->login($user);

        return $user;
    }

    /**
     * Register a new user using Google OAuth.
     */
    public function registerWithGoogle(): UserProfileResource
    {
        $googleUser = Socialite::driver('google')->user();

        $existing = User::where('email', $googleUser->getEmail())
            ->orWhere('google_id', $googleUser->getId())
            ->first();

        if ($existing) {
            abort(Response::HTTP_CONFLICT, __('app/auth/google.already_registered'));
        }

        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'signup_method' => 'google',
            'terms_accepted_at' => now(),
            'status' => true,
            'lang' => app()->getLocale(),
            'role' => 'user',
        ]);

        try {
            Mail::to($user->email)->send(new Welcome($user));
        } catch (\Throwable $e) {
            Log::error("Erreur lors de l'envoi de l'email de bienvenue (Google)", [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);
        }

        Auth::guard('web')->login($user);

        return new UserProfileResource($user);
    }
}
