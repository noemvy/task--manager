<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TasksResource\Pages;
use App\Filament\Resources\TasksResource\RelationManagers;
use App\Models\Tasks;
use App\Models\Projects;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
class TasksResource extends Resource
{
    protected static ?string $model = Tasks::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $navigationLabel = "Tareas";
    protected static ?string $modelLabel = 'Tareas';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('codigo_proyecto')
                ->label('Nombre del Proyecto')
                ->options(Projects::all()->pluck('nombre','codigo'))
                ->required()
                ->searchable()
                ->placeholder('Selecciona una opción')
                ->preload(),

            Forms\Components\TextInput::make('codigo')
                ->label('Código de Tarea')
                ->required()
                ->maxLength(20),

            Forms\Components\TextInput::make('nombre')
                ->label('Nombre de la Tarea')
                ->required()
                ->maxLength(200),

            Forms\Components\TextInput::make('descripcion')
                ->label('Indicaciones para la Tarea')
                ->maxLength(500)
                ->required(),


            Forms\Components\Select::make('status')
                ->label('Estado de la Tarea')
                ->placeholder('Selecciona una opción')
                ->options([ 'No iniciado' => '🔴 No iniciado',
                            'En progreso' => '🟡 En progreso',
                            'Finalizado' => '🟢 Finalizado',
                            ])
                ->required(),

            Forms\Components\Select::make('prioridad')
                ->label('Prioridad de la Tarea')
                ->placeholder('Selecciona una opción')
                ->options([
                    'Baja' => 'Baja',
                    'Media' => 'Media',
                    'Alta' => 'Alta',
                ])
                ->required(),
            DatePicker::make('fecha_inicio')
                ->label('Fecha de inicio')
                ->required()
                ->placeholder('Seleccione una fecha')
                ->displayFormat('d/m/Y')
                ->format('Y-m-d'),

            DatePicker::make('fecha_finalizacion')
                ->label('Fecha de Finalización')
                ->required()
                ->placeholder('Seleccione una fecha')
                ->displayFormat('d/m/Y')
                ->format('Y-m-d'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('projects.nombre')
                ->label('Proyecto'),
                TextColumn::make('nombre')
                ->label('Tarea'),
                SelectColumn::make('status')
                ->label('Estado')
                ->options([
                    'No iniciado' => '🔴 No iniciado',
                    'En progreso' => '🟡 En progreso',
                    'Finalizado' => '🟢 Finalizado',
                ]),
                TextColumn::make('prioridad')
                ->label('Prioridad')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Baja' => 'gray',
                    'Media' => 'info',
                    'Alta' => 'danger',
                    default => 'secondary',
                }),
                TextColumn::make('fecha_finalizacion')
                ->label('Finalización'),
            ])
            ->filters([
                //
                SelectFilter::make('status')
                ->label('Filtrar por Estado')
                ->options([
                    'No iniciado' => '🔴 No iniciado',
                    'En progreso' => '🟡 En progreso',
                    'Finalizado' => '🟢 Finalizado',
                ])
                ->placeholder('Selecciona un estado'),

                SelectFilter::make('projects.nombre')
                ->label('Filtrar por Proyecto')
                ->relationship('projects', 'nombre') // Relación con la tabla de proyectos
                ->placeholder('Selecciona un proyecto'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTasks::route('/create'),
            'view' => Pages\ViewTasks::route('/{record}'),
            'edit' => Pages\EditTasks::route('/{record}/edit'),
        ];
    }
}