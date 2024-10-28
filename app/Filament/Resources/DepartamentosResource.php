<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartamentosResource\Pages;
use App\Filament\Resources\DepartamentosResource\RelationManagers;
use App\Models\Departamentos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartamentosResource extends Resource
{
    protected static ?string $model = Departamentos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('id')
                // ->required(),
                Forms\Components\TextInput::make('codigo')
                ->required(),
                Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(200),
                Forms\Components\TextInput::make('descripcion')
                ->required()
                ->maxLength(300),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListDepartamentos::route('/'),
            'create' => Pages\CreateDepartamentos::route('/create'),
            'edit' => Pages\EditDepartamentos::route('/{record}/edit'),
        ];
    }
}