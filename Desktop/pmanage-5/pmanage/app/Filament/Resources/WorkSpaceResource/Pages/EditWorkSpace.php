<?php

namespace App\Filament\Resources\WorkSpaceResource\Pages;

use App\Filament\Resources\WorkSpaceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkSpace extends EditRecord
{
    protected static string $resource = WorkSpaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
