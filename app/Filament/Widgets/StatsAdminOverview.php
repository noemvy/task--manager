<?php

namespace App\Filament\Widgets;

use App\Models\Departamentos;
use App\Models\Empleados;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\Teams;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Console\View\Components\Task;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Empleados', Empleados::query()->count())
            ->description('Todos los Empleados')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),

            Stat::make('Departametos', Departamentos::query()->count())
            ->description('Todos los Departamentos')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('primary'),

            Stat::make('Equipos', Teams::query()->count())
            ->description('Todos los Equipos')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('warning'),
        ];
    }
}
