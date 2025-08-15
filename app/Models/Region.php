<?php

namespace App\Models;

use App\Traits\Author;
use App\Traits\AutoFillable;
use App\Traits\GeneratesUuid;
use App\Traits\HasStaticTableName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use Author, AutoFillable, GeneratesUuid, HasStaticTableName;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'boolean'
        ];
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class, 'region_uuid', 'uuid');
    }

    public function Reports(): HasMany
    {
        return $this->hasMany(Report::class, 'region_uuid', 'uuid');
    }
}
