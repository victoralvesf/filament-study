<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Forms\Components\StudyToggle;
use App\Models\Student;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label(__('students.fields.name')),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->label(__('students.fields.email')),
                Forms\Components\DatePicker::make('birth_date')
                    ->required()
                    ->label(__('students.fields.birth_date')),
                Forms\Components\Select::make('course_id')
                    ->relationship('course', 'title')
                    ->label(__('students.fields.course')),
                StudyToggle::make('active')
                    ->label(__('students.fields.enrollment_status')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label(__('students.fields.name')),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label(__('students.fields.email')),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date()
                    ->label(__('students.fields.birth_date')),
                Tables\Columns\BadgeColumn::make('active')
                    ->label(__('students.fields.enrollment_status'))
                    ->enum([
                        true => __('students.enums.enrollment.valid'),
                        false => __('students.enums.enrollment.invalid'),
                    ])
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ]),
                Tables\Columns\TextColumn::make('course.title')
                    ->label(__('students.fields.course')),
            ])
            ->defaultSort('name')
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
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
        return __('students.label.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('students.label.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('students.label.plural');
    }
}
