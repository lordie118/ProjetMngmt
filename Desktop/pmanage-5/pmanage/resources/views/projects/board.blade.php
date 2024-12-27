<x-filament-panels::page>
  <div class="flex flex-grow px-10 mt-4 space-x-6 overflow-auto">
    @foreach($record->groups as $group)

    <!-- To-do -->
    <div class="flex flex-col flex-shrink-0 w-72 px-1 py-2" wire:key="g-{{$group->id}}">
      <!-- board category header -->
      <div class="flex flex-row justify-between items-center mb-2 mx-1">
      <div class="flex items-center">
        <h2 class="bg-red-100 text-sm w-max px-1 rounded mr-2 text-gray-700 font-bold">{{$group->name}}</h2>

      </div>
      @if($is_owner)
      <div class="flex items-center text-gray-300">

        <x-filament::icon-button icon="heroicon-m-plus-circle"    wire:click="openCreateCardModal({{ $group->id }})"
        label="New Card" />
        <x-filament::icon-button icon="heroicon-m-trash" class="text-danger-600" wire:click="deleteGroup({{ $group }})"
        label="delete Card" />

      </div>
@endif
      </div>
      <!-- board card -->
      <div class="grid grid-rows-2 gap-2">

      @foreach($group->cards as $card)
      <div class="p-2 rounded bg-white shadow ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10" wire:key="card-{{$card->id}}">
      <div class="flex flex-row justify-between">

      <h3 class="text-sm mb-3 ">{{$card->name}} </h3>
      @if($is_owner)
      <div class="flex">

         <x-filament::icon icon="heroicon-m-pencil-square" wire:click="openEditCardModal({{ $card }})"
        label="Edit Card" class="h-3 w-3 cursor-pointer text-gray-500 dark:text-gray-400" />

        <x-filament::icon icon="heroicon-m-trash" wire:click="deleteCard({{ $card }})"
        label="Delete Task" class="h-3 w-3 cursor-pointer text-danger-600" />
        <x-filament::icon icon="heroicon-m-plus" wire:click="openCreateTaskModal({{ $card->id }})"
        label="New Task" class="h-3 w-3 cursor-pointer text-primary-500" />

      </div>
@endif
      </div>

      <p class="bg-red-100 text-xs w-max p-1 rounded mr-2 ">{{$card->description}}</p>

      <div class="tasks">

        <legend class="sr-only">tasks</legend>
        @foreach($card->tasks as $task)
        <div id="task" class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4 text-sm mb-3   border-l-transparent">
                <div class="inline-flex items-center space-x-2">
                    <div>
                        @if($task->done)
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-1 w-3 h-3 text-slate-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                          </svg>
                          @else
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-1 w-3 h-3 text-slate-500 hover:text-indigo-600 hover:cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                          @endif
                    </div>
                    <div class="text-sm mb-3  @if($task->done)line-through @endif">{{$task->name}}</div><br>
                </div>


                <div class="flex flex-row">

                <x-filament::icon icon="heroicon-m-pencil" wire:click="openEditTaskModal({{ $task }})"
        label="Edit Task" class="h-3 w-3 cursor-pointer text-gray-500 dark:text-gray-400" />
        @if($is_owner)
        <x-filament::icon icon="heroicon-m-trash" wire:click="deleteTask({{ $task }})"
        label="Delete Task" class="h-3 w-3 cursor-pointer text-danger-600" />
        @endif
                </div>


            </div>
      <p class="bg-red-100 text-xs w-max p-1 rounded mr-2 ">{{$task->description}}</p>


    @endforeach

      </div>

      </div>
    @endforeach



      </div>

    </div>



  @endforeach
  </div>

  <x-filament::modal id="cardModalForm">
    <form wire:submit.prevent="createCard">
      <div class="space-y-4">
        <div>
          <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="mountedActionsData.0.project_id">
            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
              Name<sup class="text-danger-600 dark:text-danger-400 font-medium">*</sup>
            </span>
          </label>
          <x-filament::input.wrapper>

            <x-filament::input type="text" wire:model="card_name" />
          </x-filament::input.wrapper>
        </div>
        <div>
          <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="mountedActionsData.0.project_id">
            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
              Description
            </span>
          </label>
          <x-filament::input.wrapper>

            <x-filament::input type="textarea" wire:model="card_description" label="Description" />
          </x-filament::input.wrapper>
        </div>
        <div class="text-right">
          <x-filament::button type="submit">
            Create
          </x-filament::button>
        </div>
      </div>
    </form>
  </x-filament::modal>




  <x-filament::modal id="taskModalForm">
    <form wire:submit.prevent="createTask">
      <div class="space-y-4">
        @if($is_owner)
        <div>
          <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
              Name<sup class="text-danger-600 dark:text-danger-400 font-medium">*</sup>
            </span>
          </label>
          <x-filament::input.wrapper>

            <x-filament::input type="text" wire:model="task_name" />
          </x-filament::input.wrapper>
        </div>
        <div>
          <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="mountedActionsData.0.project_id">
            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
              Description
            </span>
          </label>
          <x-filament::input.wrapper>

            <x-filament::input type="textarea" wire:model="task_description" label="Description" />
          </x-filament::input.wrapper>
        </div>

@endif


        <div>
          <label>
            <x-filament::input.checkbox wire:model="task_done" />

            <span>
              Done
            </span>
          </label>
        </div>
        <div class="text-right">
          <x-filament::button type="submit">
            Save
          </x-filament::button>
        </div>
      </div>
    </form>
  </x-filament::modal>


</x-filament-panels::page>

@push('styles')
<style>
    .line-through {
    -webkit-text-decoration-line: line-through;
    text-decoration-line: line-through;
}
.text-slate-500 {
    --tw-text-opacity: 1;
    color: rgb(100 116 139 / var(--tw-text-opacity));
}
</style>



@endpush
