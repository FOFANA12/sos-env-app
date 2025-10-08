<?php

namespace App\Repositories\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\UserProfileResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;

class LoginRepository
{

    public function apiLogin(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $credentials['status'] = true;

        if (! Auth::guard('web')->attempt($credentials)) {
            abort(Response::HTTP_UNAUTHORIZED, __('app/auth/common.invalid_credentials'));
        }

        $user = Auth::guard()->user();
        $tokenName = $request->input('device_name', 'WebApp');
        $token = $user->createToken($tokenName)->plainTextToken;

        $user->update(['last_login_at' => now()]);

        return [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserProfileResource($user),
        ];
    }

    /**
     * Handle SPA login
     *
     * @param LoginRequest $request
     * @return array<string, mixed>
     */
    public function spaLogin(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $credentials['status'] = true;

        if (! Auth::guard('web')->attempt($credentials)) {
            abort(Response::HTTP_UNAUTHORIZED, __('app/auth/common.invalid_credentials'));
        }

        $user = Auth::guard('web')->user();

        $user->update(['last_login_at' => now()]);
        
        return [
            'user' => new UserProfileResource($user),
        ];
    }

    /**
     * Redirect the user to Google's OAuth login page
     */
    public function getGoogleRedirectUrl()
    {
        session(['google_action' => 'login']);
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle API logout
     *
     * @return string
     */
    public function apiLogout()
    {
        $user = Auth::guard()->user();

        if ($user) {
            $user->currentAccessToken()?->delete();
        }

        return __('app/auth/common.logout_success');
    }

    /**
     * Handle SPA logout
     *
     * @return string
     */
    public function spaLogout()
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return __('app/auth/common.logout_success');
    }
}
