<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Support\Facades\Cache;

class StudentObserver
{
    protected static string $dashboard_stats_cache_key = 'stats:active_students';

    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }
}
