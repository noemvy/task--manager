<?php

namespace App\Filament\Resources\ProjectsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Projects;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;

use Filament\Tables\Columns\SelectColumn;
class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('codigo_proyecto')
                    ->label('Nombre del Proyecto')
                    ->options(Projects::all()->pluck('nombre','codigo'))
                    ->required()
                    ->searchable()
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
                    ->maxLength(500),


                Forms\Components\Select::make('status')
                    ->label('Estado del proyecto')
                    ->options(['No iniciado' =>'No iniciado',
                                'En progreso'=>'En progreso',
                                'Finalizado'=>'Finalizado',
                                ])
                    ->required(),

                Forms\Components\Select::make('prioridad')
                    ->label('Prioridad del proyecto')
                    ->options([ 'Baja' =>'Baja',
                                'Media'=>'Media',
                                'Alta'=>'Alta',
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Tasks')
            ->columns([
                TextColumn::make('nombre')
                ->label('Tarea'),
            SelectColumn::make('status')
                ->label('Estado')
                ->options([
                    'No iniciado' => '🔴 No iniciado',
                    'En progreso' => '🟡 En progreso',
                    'Finalizado' => '🟢 Finalizado',
                ]),
            TextColumn::make('fecha_inicio')
                ->label('Inicio'),
                TextColumn::make('fecha_finalizacion')
                ->label('Finalización'),
                ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->label('Crear Tarea'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label('editar'),
                Tables\Actions\DeleteAction::make()
                ->label('eliminar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}