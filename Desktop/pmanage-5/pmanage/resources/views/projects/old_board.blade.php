<x-filament-panels::page>
  <div class="md:flex overflow-x-auto overflow-y-hidden gap-4 pb-4">
    @foreach($record->groups as $group)

    <!-- To-do -->
    <div class="bg-white rounded px-2 py-2" wire:key="g-{{$group->id}}">
      <!-- board category header -->
      <div class="flex flex-row justify-between items-center mb-2 mx-1">
      <div class="flex items-center">
        <h2 class="bg-red-100 text-sm w-max px-1 rounded mr-2 text-gray-700 font-bold">{{$group->name}}</h2>

      </div>
      <div class="flex items-center text-gray-300">
        <p class="mr-2 text-2xl">---</p>
        <x-filament::icon-button icon="heroicon-m-plus" wire:click="openCreateCardModal({{ $group->id }})"
        label="New Card" />
      </div>
      </div>
      <!-- board card -->
      <div class="grid grid-rows-2 gap-2">

      @foreach($group->cards as $card)
      <div class="p-2 rounded shadow-sm border-gray-100 border-2" wire:key="card-{{$card->id}}">
      <div class="flex flex-row justify-between">

      <h3 class="text-sm mb-3 text-gray-700">{{$card->name}} </h3>
      <div class="flex">
      <x-filament::icon icon="heroicon-m-pencil" wire:click="openEditCardModal({{ $card }})" label="Edit Card"
        class="h-3 w-3 cursor-pointer text-gray-500 dark:text-gray-400" />
        <x-filament::icon-button icon="heroicon-m-plus" class="h-3 w-3" wire:click="openCreateTaskModal({{ $card->id }})"
      label="New Task" />
      </div>

      </div>

      <p class="bg-red-100 text-xs w-max p-1 rounded mr-2 text-gray-700">{{$card->description}}</p>

      <div class="flex flex-row items-center mt-2">
      <fieldset>
        <legend class="sr-only">tasks</legend>
        @foreach($card->tasks as $task)
      <div class="space-y-2 mb-2">
      <label for="Option1"
      class="flex cursor-pointer items-start gap-4 rounded-lg border border-gray-200 py-1 px-2 transition hover:bg-gray-50">
      <div class="flex items-center">
      &#8203;
      <input type="checkbox" class="size-4 rounded border-gray-300" id="Option1" {{($task->done) ? 'checked' : ''}} />
      </div>

      <div>
      <p class="text-sm mb-3 text-gray-700"> {{$task->name}} </p>

      <p class="mt-1  text-xs text-sm text-gray-700">
        {{$task->description}}
      </p>
      <x-filament::icon icon="heroicon-m-pencil" wire:click="openEditTaskModal({{ $task }})"
        label="Edit Task" class="h-3 w-3 cursor-pointer text-gray-500 dark:text-gray-400" />
      </div>
      </label>




      </div>
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
            Create
          </x-filament::button>
        </div>
      </div>
    </form>
  </x-filament::modal>


</x-filament-panels::page>
