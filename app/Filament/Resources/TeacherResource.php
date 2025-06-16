<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Forms\Components\StudyToggle;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label(__('teachers.fields.name')),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->label(__('teachers.fields.email')),
                Forms\Components\DatePicker::make('hire_date')
                    ->required()
                    ->label(__('teachers.fields.hire_date')),
                StudyToggle::make('is_active')
                    ->label(__('teachers.fields.is_active')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('teachers.fields.name')),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('teachers.fields.email')),
                Tables\Columns\BadgeColumn::make('is_active')
                    ->label(__('teachers.fields.is_active'))
                    ->enum([
                        true => __('teachers.enums.employment.valid'),
                        false => __('teachers.enums.employment.invalid'),
                    ])
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ]),
                Tables\Columns\TextColumn::make('hire_date')
                    ->date()
                    ->label(__('teachers.fields.hire_date')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getModelLabel(): string
    {
        return __('teachers.label.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('teachers.label.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('teachers.label.plural');
    }
}
