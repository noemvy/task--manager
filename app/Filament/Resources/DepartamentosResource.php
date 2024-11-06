<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartamentosResource\Pages;
use App\Filament\Resources\DepartamentosResource\RelationManagers;
use App\Models\Departamentos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DepartamentosResource\RelationManagers\EmpleadoRelationManager;

class DepartamentosResource extends Resource
{
    protected static ?string $model = Departamentos::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')
                    ->required(),
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(200),
                Forms\Components\Textarea::make('descripcion')
                    ->required()
                    ->maxLength(300),




            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo')->label('Codigo')->sortable()->searchable(),
                TextColumn::make('nombre')->label('Nombre')->sortable()->searchable(),
                TextColumn::make('empleados_count')
                ->label('Empleados')
                ->counts('empleados'),
                TextColumn::make('teams_count')
                ->label('Equipos')
                ->counts('teams'),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartamentos::route('/'),
            'create' => Pages\CreateDepartamentos::route('/create'),
            'edit' => Pages\EditDepartamentos::route('/{record}/edit'),
        ];
    }


}
