<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        $active_students = Student::active()->count();
        $active_courses = Course::count();
        $active_teachers = Teacher::count();

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
