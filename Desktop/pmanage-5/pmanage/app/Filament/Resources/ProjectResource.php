<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Facades\Filament;

use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class ProjectResource extends Resource
{

  //  protected static ?string $tenantRelationshipName = 'projects';
  //  protected static ?string $tenantOwnershipRelationshipName = 'work_space';

    protected static ?string $model = Project::class;
    public $current_workspace;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function form(Form $form): Form
    {

        return $form
            ->schema([
              //  Forms\Components\Select::make('workspace_id')
                 //   ->relationship('workSpace', 'id')
                 //   ->required(true),
                Forms\Components\TextInput::make('name')
                    ->required(true),
                Forms\Components\Textarea::make('description'),
                Forms\Components\DateTimePicker::make('start_date'),
                Forms\Components\DateTimePicker::make('end_date')
            ]);
    }

    public static function table(Table $table): Table
    {

        $current_workspace = Filament::getTenant();
        $user = auth()->user();
        if($user->id === $current_workspace->owner_id){
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('workSpace.id'),
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('description'),
            Tables\Columns\TextColumn::make('start_date')
                ->dateTime(),
            Tables\Columns\TextColumn::make('end_date')
                ->dateTime()
        ])
        ->filters([
            Tables\Filters\TrashedFilter::make(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\ViewAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]),
        ]);
}else{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('workSpace.id'),
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('description'),
            Tables\Columns\TextColumn::make('start_date')
                ->dateTime(),
            Tables\Columns\TextColumn::make('end_date')
                ->dateTime()
        ])
        ->filters([
            Tables\Filters\TrashedFilter::make(),
        ])
        ->actions([

            Tables\Actions\ViewAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]),
        ]);
}
       }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
            'view' => Pages\ViewProject::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
