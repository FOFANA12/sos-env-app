<?php

namespace App\Repositories;

use App\Helpers\FileHelper;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\Auth\UserProfileResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileRepository
{
    protected string $basePath = 'uploads/avatars';

    /**
     * Get the user's profile.
     */
    public function getProfile()
    {
        $user = Auth::user();
        return new UserProfileResource($user);
    }

    /**
     * Update the user's profile.
     */
    public function update(ProfileRequest $request)
    {
        $user = $request->user();

        $oldAvatarName = $user->avatar;
        $newAvatarName = null;

        DB::beginTransaction();
        try {
            $user->fill($request->only([
                'name',
                'phone',
                'lang',
            ]));

            if ($request->boolean('delete_avatar') && $oldAvatarName) {
                FileHelper::delete("{$this->basePath}/{$oldAvatarName}");
                $user->avatar = null;
            }

            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    FileHelper::delete("{$this->basePath}/{$user->avatar}");
                }
                $avatarFile = $request->file('avatar');
                $newAvatarName = FileHelper::upload($avatarFile, $this->basePath);
                $user->avatar = $newAvatarName;

                if ($oldAvatarName && $oldAvatarName !== $newAvatarName) {
                    FileHelper::delete("{$this->basePath}/{$oldAvatarName}");
                }
            }

            // Only allow email & password updates if not linked to Google
            if (is_null($user->google_id)) {
                if ($request->filled('email')) {
                    $user->email = $request->input('email');
                }
            }

            if ($request->filled('password') && $user->signup_method !== 'google') {
                $user->password = Hash::make($request->input('password'));
            }

            $user->save();

            DB::commit();

            return new UserProfileResource($user);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
