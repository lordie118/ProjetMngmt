<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Facades\Filament;

use Filament\Resources\Pages\ListRecords;
use App\Traits\MainMenu;

class ListProjects extends ListRecords
{
    use MainMenu;
    public $current_workspace;

    protected static string $resource = ProjectResource::class;


    public function mount(): void
    {

        parent::mount();

        $this->rebuidMenu();
    }
    protected function getHeaderActions(): array
    {

        $this->current_workspace = Filament::getTenant();
       $user = auth()->user();

        if ($user->id === $this->current_workspace->owner_id) {
       return [
        Actions\CreateAction::make(),
        ];
      } else {

       return [];
      }


    }
}
