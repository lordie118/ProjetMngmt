<?php

namespace App\Filament\Resources\WorkSpaceResource\Pages;

use App\Filament\Resources\WorkSpaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkSpaces extends ListRecords
{
    protected static string $resource = WorkSpaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
