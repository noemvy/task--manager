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

    public static function table(Table $table): Table
    {
        return $table
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
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
