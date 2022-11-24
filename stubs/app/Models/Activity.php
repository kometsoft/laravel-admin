<?php

namespace Tabler\App\Models;

use Spatie\Activitylog\Models\Activity as Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;

class Activity extends Model implements ActivityContract
{
    public function subject(): MorphTo
    {
        if (config('activitylog.subject_returns_soft_deleted_models')) {
            return $this->morphTo()->withDefault(['name' => '—'])->withTrashed();
        }

        return $this->morphTo()->withDefault(['name' => '—']);
    }

    public function causer(): MorphTo
    {
        return $this->morphTo()->withDefault(['name' => '—']);
    }
}
