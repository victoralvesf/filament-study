<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\Cache;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        $ttl = now()->addHours(10);

        $active_students = Cache::remember('stats:active_students', $ttl, function () {
            return Student::active()->count();
        });
        $active_courses = Cache::remember('stats:active_courses', $ttl, function () {
            return Course::active()->count();
        });
        $active_teachers = Cache::remember('stats:active_teachers', $ttl, function () {
            return Teacher::active()->count();
        });

        return [
            Card::make(__('dashboard.stats.students.title'), $active_students)
                ->description(__('dashboard.stats.students.summary'))
                ->descriptionIcon('heroicon-o-academic-cap')
                ->color('primary'),

            Card::make(__('dashboard.stats.courses.title'), $active_courses)
                ->description(__('dashboard.stats.courses.summary'))
                ->descriptionIcon('heroicon-o-library')
                ->color('primary'),

            Card::make(__('dashboard.stats.teachers.title'), $active_teachers)
                ->description(__('dashboard.stats.teachers.summary'))
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('primary'),
        ];
    }
}
