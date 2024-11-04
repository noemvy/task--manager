<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectsResource\Pages;
use App\Filament\Resources\ProjectsResource\RelationManagers;
use App\Models\Projects;
use App\Models\Teams;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;

class ProjectsResource extends Resource
{
    protected static ?string $model = Projects::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $modelLabel = 'Proyectos';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('codigo_team')
                ->label('Código de Equipo')
                ->options(Teams::all()->pluck('nombre','codigo'))
                    ->required()
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('codigo_proyecto')
                    ->label('Código de Proyecto')
                    ->required()
                    ->maxLength(20),

                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre del Proyecto')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('descripcion')
                    ->required()
                    ->maxLength(255),

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
                    TextColumn::make('teams.nombre')
                    ->label('Equipo')
                    ->sortable(),

                    TextColumn::make('nombre')
                    ->label('Nombre del Proyecto')
                    ->sortable()
                    ->searchable(),

                    TextColumn::make('status')
                    ->label('Estado del Proyecto')
                    ->sortable()
                    ->searchable(),

                    TextColumn::make('prioridad')
                    ->label('Prioridad del Proyecto')
                    ->sortable()
                    ->searchable(),

                    // TextColumn::make('fecha_inicio')
                    // ->label('Fecha Inicio')
                    // ->sortable()
                    // ->searchable(),

                    TextColumn::make('fecha_finalizacion')
                    ->label('Fecha Finalización')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->label('vista'),
                Tables\Actions\EditAction::make()
                ->label('editar'),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProjects::route('/create'),
            'view' => Pages\ViewProjects::route('/{record}'),
            'edit' => Pages\EditProjects::route('/{record}/edit'),
        ];
    }
}
