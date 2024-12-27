<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\Group;
use App\Models\Card;
use App\Models\Project;
use App\Models\Task;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Notifications\Notification;
use Livewire\Component;
use Filament\Facades\Filament;
use Filament\Navigation\MenuItem;
use App\Traits\MainMenu;


class ViewProject extends ViewRecord
{
    use MainMenu;
    protected static string $view = 'projects.board';
    protected static string $resource = ProjectResource::class;

    //card vars
    public Card $card;
    public Group $group;
    public task $task;
    public $card_groupId;
    public $card_name;
    public $task_name;
    public $card_description;
    public $task_description;
    public $task_done = false;
    public $card_edition = false;
    public $current_workspace;
    public $is_owner =false;
    public $task_cardId;
    public $task_edition = false;

    public function mount(int | string $record): void
    {
        parent::mount($record);
        $this->current_workspace = Filament::getTenant();
        $user = auth()->user();
        if($user->id === $this->current_workspace->owner_id){
$this->is_owner = true;
        }
$this->rebuidMenu();
    }

    public function reloadRecord()
    {
        $this->record = Project::findOrFail($this->record->id);
    }


    protected function getHeaderActions(): array
    {

        if($this->is_owner){
            return [
            Actions\CreateAction::make()->model(Group::class)
                ->form([
                  //  Forms\Components\Select::make('project_id')
                     //   ->relationship('project', 'name')
                     //   ->required(true),
                    Forms\Components\TextInput::make('name')
                        ->required(true),
                    Forms\Components\Textarea::make('description')
                ]) ->mutateFormDataUsing(function (array $data): array {
                    $data['project_id'] = $this->record->id;
                    return $data;
               })
        ];
        }else{
            return [];
        }

    }


    //card
    public function openCreateCardModal($groupId)
    {
        $this->reset(['card_name', 'card_description', 'card_groupId']);
        $this->card_groupId = $groupId;
        $this->dispatch('open-modal', id: 'cardModalForm');
    }
    public function openEditCardModal(Card $card)
    {
        $this->card_edition = true;
        $this->card = $card;
        $this->card_groupId = $this->card->group_id;
        $this->card_name = $this->card->name;
        $this->card_description = $this->card->description;
        $this->dispatch('open-modal', id: 'cardModalForm');
    }


    public function deleteCard(Card $card)
    {
        $card->delete();
        $notif = Notification::make()
        ->success()
        ->title('Card')
        ->body('Card deleted successfully!');
    }

    public function createCard()
    {
        $this->validate([
            'card_name' => 'required|string|max:255',
        ]);
        if ($this->card_edition) {
            $this->card->name = $this->card_name;
            $this->card->description = $this->card_description;
            $this->card->group_id = $this->card_groupId;

            $this->card->save();
            $notif = Notification::make()
                ->success()
                ->title('Card')
                ->body('Card updated successfully!');

        } else {
            Card::create([
                'name' => $this->card_name,
                'description' => $this->card_description,
                'group_id' => $this->card_groupId,
            ]);
            $notif = Notification::make()
                ->success()
                ->title('Card')
                ->body('Card created successfully!');
            ;

        }

        $this->card_edition = false;
        $this->reset(['card_name', 'card_description', 'card_groupId']);

        $this->dispatch('close-modal', id: 'cardModalForm');

        $notif->send();


    }





    //task

     //card
     public function openCreateTaskModal($cardId)
     {
        $this->reset(['task_name', 'task_description', 'task_cardId','task_done']);
         $this->task_cardId = $cardId;
         $this->dispatch('open-modal', id: 'taskModalForm');
     }
     public function openEditTaskModal(Task $task)
     {
         $this->task_edition = true;
         $this->task = $task;
         $this->task_cardId = $this->task->card_id;
         $this->task_name = $this->task->name;
         $this->task_done = $this->task->done;
         $this->task_description = $this->task->description;
         $this->dispatch('open-modal', id: 'taskModalForm');
     }

     public function createTask()
     {
         $this->validate([
             'task_name' => 'required|string|max:255',
         ]);
         if ($this->task_edition) {
             $this->task->name = $this->task_name;
             $this->task->description = $this->task_description;
             $this->task->done = $this->task_done;
             $this->task->card_id = $this->task_cardId;

             $this->task->save();
             $notif = Notification::make()
                 ->success()
                 ->title('Task')
                 ->body('Task updated successfully!');

         } else {
             Task::create([
                 'name' => $this->task_name,
                 'description' => $this->task_description,
                 'done' => $this->task_done,
                 'card_id' => $this->task_cardId,
             ]);
             $notif = Notification::make()
                 ->success()
                 ->title('Task')
                 ->body('Task created successfully!');
             ;

         }

         $this->task_edition = false;
         $this->reset(['task_name', 'task_description', 'task_cardId','task_done']);

         $this->dispatch('close-modal', id: 'taskModalForm');

         $notif->send();


     }

     public function deleteTask(Task $task)
    {
        $task->delete();
        $notif = Notification::make()
        ->success()
        ->title('Task')
        ->body('Task deleted successfully!');
    }
     public function deleteGroup(Group $group)
    {
        $group->delete();
        $notif = Notification::make()
        ->success()
        ->title('Group')
        ->body('Group deleted successfully!');
    }






}
