<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeFormatter;
use App\Helpers\FileHelper;
use App\Support\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $currentLang = app()->getLocale();
        $mode = $this->additional['mode'] ?? $request->input('mode', 'view');

        return match ($mode) {
            'list' => $this->forList($currentLang),
            'edit' => $this->forEdit(),
            default => $this->forView($currentLang),
        };
    }

    private function forList(string $locale): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => Role::name($this->role, $locale),
            'created_at' =>  DateTimeFormatter::formatDatetime($this->created_at),
            'status' => $this->status,
        ];
    }

    private function forEdit(): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'signup_method' => $this->signup_method,
            'terms_accepted_at' => DateTimeFormatter::formatDatetime($this->terms_accepted_at),
            'last_login_at' => $this->last_login_at
                ? DateTimeFormatter::formatDatetime($this->last_login_at)
                : null,
            'avatar_url'   => $this->avatar ? FileHelper::url("uploads/avatars/{$this->avatar}") : null,
            'status' => $this->status,
        ];
    }

    private function forView(string $locale): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => Role::get($this->role, $locale),
            'signup_method' => $this->signup_method,
            'terms_accepted_at' => DateTimeFormatter::formatDatetime($this->terms_accepted_at),
            'last_login_at' => $this->last_login_at
                ? DateTimeFormatter::formatDatetime($this->last_login_at)
                : null,
            'avatar_url'   => $this->avatar ? FileHelper::url("uploads/avatars/{$this->avatar}") : null,
            'status' => $this->status,
        ];
    }
}
