<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Toggle;

class StudyToggle extends Toggle
{
    public static function make(string $name): static
    {
        return parent::make($name)
            ->inline()
            ->default(true)
            ->onIcon('heroicon-o-check')
            ->onColor('success')
            ->offIcon('heroicon-o-x')
            ->offColor('danger');
    }
}
