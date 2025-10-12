<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeFormatter;
use App\Helpers\FileHelper;
use App\Support\ReportStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return match ($request->mode) {
            'list' => $this->forList(),
            'edit' => $this->forEdit(),
            default => $this->forView(),
        };
    }

    protected function forList(): array
    {
        $currentLang = app()->getLocale();
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => DateTimeFormatter::formatDatetime($this->created_at),
            'location' => implode(', ', array_filter([
                $this->neighborhood,
                $this->department,
                $this->region,
            ])),
            'user' => $this->user,
            'status' => ReportStatus::get($this->status, $currentLang),
            'image_url' => $this->image
                ? FileHelper::url("uploads/reports/{$this->image}")
                : null,
        ];
    }

    protected function forEdit(): array
    {
        $currentLang = app()->getLocale();
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->longitude && $this->latitude ? ['lat' => $this->latitude, 'lng' => $this->longitude] : null,
            'status' => ReportStatus::get($this->status, $currentLang),
            'region' => $this->region_uuid,
            'department' => $this->department_uuid,
            'neighborhood' => $this->neighborhood_uuid,
            'image_url'     => $this->image
                ? FileHelper::url("uploads/reports/{$this->image}")
                : null,

            'photos'        => $this->photos
                ? $this->photos->map(fn($photo) => [
                    'uuid' => $photo->uuid,
                    'url' => $photo->identifier
                        ? FileHelper::url("uploads/reports/{$this->uuid}/photos/{$photo->identifier}")
                        : null,
                ])
                : [],
        ];
    }
    protected function forView(): array
    {
        $currentLang = app()->getLocale();
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->longitude && $this->latitude ? ['lat' => $this->latitude, 'lng' => $this->longitude] : null,
            'status' => ReportStatus::get($this->status, $currentLang),
            'region' => $this->region ? $this->region->name : null,
            'department' => $this->department ? $this->department->name : null,
            'neighborhood' => $this->neighborhood ? $this->neighborhood->name : null,
            'image_url' => $this->image
                ? FileHelper::url("uploads/reports/{$this->image}")
                : null,

            'photos'        => $this->photos
                ? $this->photos->map(fn($photo) => [
                    'uuid' => $photo->uuid,
                    'url' => $photo->identifier
                        ? FileHelper::url("uploads/reports/{$this->uuid}/photos/{$photo->identifier}")
                        : null,
                ])
                : [],
        ];
    }
}
