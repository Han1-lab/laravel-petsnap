<?php

namespace App\Filament\Resources\DiagnosaResource\Pages;

use App\Filament\Resources\DiagnosaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiagnosas extends ListRecords
{
    protected static string $resource = DiagnosaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
