<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamsResource\Pages;
use App\Filament\Resources\TeamsResource\RelationManagers;
use App\Models\Teams;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Departamentos;
use App\Models\Empleados;
use Filament\Forms\FormsComponent;

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
                ->label('Codigo de Equipo')
                ->required()
                ->maxLength(50),

            Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('codigo_departamento')
                ->label('Departamento')
                ->options(Departamentos::all()->pluck('nombre', 'codigo'))
                ->searchable()
                ->placeholder('Selecciona un departamento')
                ->required()
                ->reactive()
                ->afterStateUpdated(function (callable $set) {
                    // Limpia el campo 'cedula_empleado' cuando cambia el departamento
                    $set('cedula_empleado', null);
                }),

            Forms\Components\Select::make('cedula_empleado')
                ->label('Empleado')
                ->options(function ($get) {
                    $codigoDepartamento = $get('codigo_departamento');
                    // Filtra empleados solo si un departamento está seleccionado
                    if ($codigoDepartamento) {
                        return Empleados::where('codigo_departamento', $codigoDepartamento)
                        ->selectRaw("CONCAT(nombre, ' ', apellido) AS full_name, cedula")
                        ->pluck('full_name', 'cedula');
                    }
                    return [];
                })
                ->searchable()
                ->placeholder('Selecciona un empleado')
                ->required(),
                Forms\Components\TextInput::make('descripcion')
                ->label('Descripción')
                ->maxLength((300)),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('departamentos_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('empleados_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
