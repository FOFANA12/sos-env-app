<?php

namespace App\Models;

use App\Traits\Author;
use App\Traits\AutoFillable;
use App\Traits\GeneratesUuid;
use App\Traits\HasStaticTableName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Neighborhood extends Model
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

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_uuid', 'uuid');
    }
    
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'neighborhood_uuid', 'uuid');
    }
}
