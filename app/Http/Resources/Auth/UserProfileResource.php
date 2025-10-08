<?php

namespace App\Http\Resources\Auth;

use App\Helpers\DateTimeFormatter;
use App\Helpers\FileHelper;
use App\Support\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'avatar_url'   => $this->avatar ? FileHelper::url("uploads/avatars/{$this->avatar}") : null,
            'role' => Role::get($this->role, app()->getLocale()),
            'signup_method' => $this->signup_method,
            'is_google_linked' => !is_null($this->google_id),
            'status' => (bool) $this->status,
            'terms_accepted_at' => DateTimeFormatter::formatDatetime($this->terms_accepted_at),
            'last_login_at' => $this->last_login_at
                ? DateTimeFormatter::formatDatetime($this->last_login_at)
                : null,
        ];
    }
}
