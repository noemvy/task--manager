<?php

namespace App\Filament\Widgets;

use App\Models\Tasks;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\SelectColumn;
class StatsTasksOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Tareas';

    protected static ?int $sort = 3;

    protected function getTableQuery(): Builder
    {
        return Tasks::query()
            ->with('projects') // Asegúrate de tener la relación definida en el modelo
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('nombre')
                ->label('Nombre de la Tarea')
                ->searchable()
                ->sortable(),

                SelectColumn::make('status')
                ->label('Estado')
                ->options([
                    'No iniciado' => '🔴 No iniciado',
                    'En progreso' => '🟡 En progreso',
                    'Finalizado' => '🟢 Finalizado',
                ]),
            TextColumn::make('fecha_finalizacion')
                ->label('Fecha Límite'),
        ];
    }
}