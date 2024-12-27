<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;
use Filament\Forms\Form;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('card_id')
                ->relationship('card', 'id')
                ->required(true),
            Forms\Components\TextInput::make('name')
                ->required(true),
            Forms\Components\Textarea::make('description')
            ]);
    }


}
