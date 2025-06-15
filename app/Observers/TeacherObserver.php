<?php

namespace App\Observers;

use App\Models\Teacher;
use Illuminate\Support\Facades\Cache;

class TeacherObserver
{
    protected static string $dashboard_stats_cache_key = 'stats:active_teachers';

    /**
     * Handle the Teacher "created" event.
     */
    public function created(Teacher $teacher): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Teacher "updated" event.
     */
    public function updated(Teacher $teacher): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Teacher "deleted" event.
     */
    public function deleted(Teacher $teacher): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Teacher "restored" event.
     */
    public function restored(Teacher $teacher): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Teacher "force deleted" event.
     */
    public function forceDeleted(Teacher $teacher): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }
}
