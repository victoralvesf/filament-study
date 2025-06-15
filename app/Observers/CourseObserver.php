<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class CourseObserver
{
    protected static string $dashboard_stats_cache_key = 'stats:active_courses';

    /**
     * Handle the Course "created" event.
     */
    public function created(Course $course): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Course "updated" event.
     */
    public function updated(Course $course): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Course "deleted" event.
     */
    public function deleted(Course $course): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Course "restored" event.
     */
    public function restored(Course $course): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }

    /**
     * Handle the Course "force deleted" event.
     */
    public function forceDeleted(Course $course): void
    {
        Cache::forget(self::$dashboard_stats_cache_key);
    }
}
