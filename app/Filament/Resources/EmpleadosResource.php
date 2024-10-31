<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpleadosResource\Pages;
use App\Filament\Resources\EmpleadosResource\RelationManagers;
use App\Models\Empleados;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Departamentos;
use App\Models\Team;
use Filament\Tables\Columns\TextColumn;

class EmpleadosResource extends Resource
{
    protected static ?string $model = Empleados::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Ingrese los datos del empleado')
                ->schema([
                    Forms\Components\Select::make('codigo_departamento')
                    ->label('Departamento')
                    ->options(Departamentos::all()->pluck('nombre','codigo'))
                    ->searchable()
                    ->placeholder('Selecciona un departamento')
                    ->required(),
                Forms\Components\TextInput::make('cedula')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('apellido')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('correo')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->columnSpanFull(),
                ])->columns(2)
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->label('Nombre')->sortable()->searchable(),
                TextColumn::make('cedula')->label('Cédula')->sortable()->searchable(),
                TextColumn::make('departamento.nombre')
                ->label('Departamentos')
                ->sortable()


            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListEmpleados::route('/'),
            'create' => Pages\CreateEmpleados::route('/create'),
            'edit' => Pages\EditEmpleados::route('/{record}/edit'),
        ];
    }
}