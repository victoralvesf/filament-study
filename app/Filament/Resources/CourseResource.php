<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Forms\Components\StudyToggle;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-library';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)
                    ->schema([
                        Section::make('Informações')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->label(__('courses.fields.title')),
                                        Forms\Components\Select::make('teacher_id')
                                            ->relationship('teacher', 'name')
                                            ->label(__('courses.fields.teacher')),
                                    ]),
                                Grid::make(1)
                                    ->schema([
                                        Forms\Components\RichEditor::make('description')
                                            ->required()
                                            ->disableToolbarButtons([
                                                'attachFiles',
                                                'codeBlock',
                                            ])
                                            ->label(__('courses.fields.description')),
                                    ]),
                            ])
                            ->columns(2),
                        Section::make('Situação')
                            ->schema([
                                StudyToggle::make('is_active')
                                    ->label(__('courses.fields.is_active')),
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('courses.fields.title')),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->label(__('courses.fields.teacher')),
                Tables\Columns\BadgeColumn::make('is_active')
                    ->label(__('courses.fields.is_active'))
                    ->enum([
                        true => __('courses.enums.status.valid'),
                        false => __('courses.enums.status.invalid'),
                    ])
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->label(__('courses.fields.created_at')),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
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
        return __('courses.label.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('courses.label.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('courses.label.plural');
    }
}
