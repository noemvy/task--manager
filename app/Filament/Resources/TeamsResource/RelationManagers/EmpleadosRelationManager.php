<?php

namespace App\Filament\Resources\TeamsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Empleados;

class EmpleadosRelationManager extends RelationManager
{
    protected static string $relationship = 'empleados'; // Asegúrate de que la relación en el modelo Teams se llame 'empleados'
    protected static ?string $recordTitleAttribute = 'nombre';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }



    public function table(Table $table): Table
    {

        return $table
        ->columns([
            Tables\Columns\TextColumn::make('cedula')->label('Cédula')->sortable(),
            Tables\Columns\TextColumn::make('nombre')->label('Nombre')->sortable(),
            Tables\Columns\TextColumn::make('apellido')->label('Apellido')->sortable(),
        ]);
    }


}
