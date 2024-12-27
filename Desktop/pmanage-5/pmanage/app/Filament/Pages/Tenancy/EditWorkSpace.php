<?php
namespace App\Filament\Pages\Tenancy;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Pages\Actions\DeleteAction;
use Filament\Pages\Tenancy\EditTenantProfile;
use Illuminate\Support\Facades\Auth;
use App\Models\Workspace;
use Filament\Facades\Filament;

class EditWorkSpace extends EditTenantProfile
{

    public function mount():void
    {

            $this->tenant = Filament::getTenant();

            abort_unless(static::canView($this->tenant), 404);

            $this->fillForm();
            if ($this->tenant->owner_id !== Auth::id()) {
                abort(403);
            }
    }

    public static function getLabel(): string
    {
        return 'Edit Workspace';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(true),
                Textarea::make('description')
            ]);
    }

    protected function getHeaderActions(): array
    {
        if ($this->tenant->owner_id == Auth::id()) {
        return [
            DeleteAction::make()
                ->record($this->tenant)
                ->action(function ($record) {
                    if ($record->owner_id !== Auth::id()) {
                        abort(403);
                    }

                    $record->delete();

                    session()->flash('success', 'Workspace deleted successfully!');

                    return back();
                })
                ->requiresConfirmation(),
        ];
    }else{
        return [];
    }
    }
}
