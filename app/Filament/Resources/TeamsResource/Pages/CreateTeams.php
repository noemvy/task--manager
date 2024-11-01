<?php

namespace App\Filament\Resources\TeamsResource\Pages;

use App\Filament\Resources\TeamsResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;


class CreateTeams extends CreateRecord
{
    protected static string $resource = TeamsResource::class;


}