<?php
namespace App\Filament\Pages\Tenancy;

use App\Models\WorkSpace;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterWorkSpace extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Workspace';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(true),
            Textarea::make('description')
            ]);
    }

    protected function handleRegistration(array $data): WorkSpace
    {
        $data['owner_id']= auth()->user()->id;
        $workspace = WorkSpace::create($data);

        $workspace->members()->attach(auth()->user());

        return $workspace;
    }
}
