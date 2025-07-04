<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Observers\CourseObserver;
use App\Observers\StudentObserver;
use App\Observers\TeacherObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Course::observe(CourseObserver::class);
        Student::observe(StudentObserver::class);
        Teacher::observe(TeacherObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
