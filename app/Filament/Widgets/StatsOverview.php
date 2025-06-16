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
            return Teacher::count();
        });

        return [
            Card::make('Alunos ativos', $active_students)
                ->description('Quantidade de alunos com matrícula ativa.')
                ->descriptionIcon('heroicon-o-academic-cap')
                ->color('primary'),
            Card::make('Cursos ativos', $active_courses)
                ->description('Quantidade de cursos ministrados no momento.')
                ->descriptionIcon('heroicon-o-library')
                ->color('primary'),
            Card::make('Professores ativos', $active_teachers)
                ->description('Quantidade de professores ministrando cursos no momento.')
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('primary'),
        ];
    }
}
