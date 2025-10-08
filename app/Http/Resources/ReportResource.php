<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeFormatter;
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'status' => ReportStatus::get($this->status, $currentLang),
            'region' => $this->region_uuid,
            'department' => $this->department_uuid,
            'neighborhood' => $this->neighborhood_uuid,
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'status' => ReportStatus::get($this->status, $currentLang),
            'region' => $this->region ? $this->region->name : null,
            'department' => $this->department ? $this->department->name : null,
            'neighborhood' => $this->neighborhood ? $this->neighborhood->name : null,
        ];
    }
}
