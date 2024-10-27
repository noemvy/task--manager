<?php

namespace App\Filament\Resources\TeamsResource\Pages;

use App\Filament\Resources\TeamsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTeams extends ViewRecord
{
    protected static string $resource = TeamsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
