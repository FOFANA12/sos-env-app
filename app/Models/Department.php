<?php

namespace App\Models;

use App\Traits\Author;
use App\Traits\AutoFillable;
use App\Traits\GeneratesUuid;
use App\Traits\HasStaticTableName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
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

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_uuid', 'uuid');
    }

    public function neighborhoods(): HasMany
    {
        return $this->hasMany(Neighborhood::class, 'department_uuid', 'uuid');
    }

    public function Reports(): HasMany
    {
        return $this->hasMany(Report::class, 'department_uuid', 'uuid');
    }
}
