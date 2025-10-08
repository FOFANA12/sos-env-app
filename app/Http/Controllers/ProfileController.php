<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Repositories\ProfileRepository;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    private $messageSuccessUpdate;
    private ProfileRepository $repository;

    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
        $this->messageSuccessUpdate = __('app/profile.controller.message_success_update');
    }

    /**
     * Retrieve the currently logged-in user's profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile()
    {
        $user = $this->repository->getProfile();

        return response()->json(['user' => $user], Response::HTTP_OK);
    }

    /**
     * Update the user's profile with the provided data.
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProfileRequest $request)
    {
        $updatedUser = $this->repository->update($request);

        return response()->json([
            'message' => $this->messageSuccessUpdate,
            'user' => $updatedUser,
        ], Response::HTTP_OK);
    }

    /**
     * Redirect the user to the profile page after profile update with a flash success message.
     */
    public function webProfileRedirect()
    {
        return redirect()
            ->route('profile')
            ->with('success', __('app/profile.controller.message_success_update'));
    }
}
