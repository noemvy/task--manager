<?php

namespace App\Filament\Widgets;

use App\Models\Projects;
use App\Models\Tasks;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\SelectColumn;
class StatsProjectsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;
    protected static ?string $heading = 'Proyectos';

    protected function getTableQuery(): Builder
    {
        return Projects::query()
            ->withCount('tasks')
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('nombre')
                ->label('Nombre')
                ->searchable()
                ->sortable(),

            SelectColumn::make('status')
            ->label('Estado')
            ->options([
                'No iniciado' => '🔴 No iniciado',
                'En progreso' => '🟡 En progreso',
                'Finalizado' => '🟢 Finalizado',
            ]),

            TextColumn::make('prioridad')
                ->label('Prioridad')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Baja' => 'gray',
                    'Media' => 'info',
                    'Alta' => 'danger',
                    default => 'secondary',
                }),

            TextColumn::make('fecha_finalizacion')
            ->label('Finalización'),


        ];

    }

    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }


}