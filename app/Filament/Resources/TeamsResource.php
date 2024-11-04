<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamsResource\Pages;
use App\Models\Teams;
use App\Models\Departamentos;
use App\Models\Empleados;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeamsResource extends Resource
{
    protected static ?string $model = Teams::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Equipos';
    protected static ?string $modelLabel = 'Equipos';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')
                    ->label('Código de Equipo')
                    ->required()
                    ->maxLength(50),

                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre del Equipo')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('codigo_departamento')
                    ->label('Departamento')
                    ->options(Departamentos::all()->pluck('nombre', 'codigo'))
                    ->searchable()
                    ->placeholder('Selecciona un departamento')
                    ->required(),

                Forms\Components\TextInput::make('descripcion')
                    ->label('Descripción')
                    ->maxLength(300),
                Forms\Components\Select::make('empleados') // Campo para seleccionar empleados
                    ->label('Empleados')
                    ->relationship('empleados', 'nombre') // Cambia 'nombre' por el campo que deseas mostrar
                    ->multiple() // Permite seleccionar múltiples empleados
                    ->preload(),// Carga los empleados antes de que el usuario interactúe

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('departamento.nombre')
                    ->label('Código del Departamento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),

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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeams::route('/create'),
            'view' => Pages\ViewTeams::route('/{record}'),
            'edit' => Pages\EditTeams::route('/{record}/edit'),
        ];
    }
}