<x-filament-panels::page>

    @if($is_owner)
    <div class="grid flex-1 auto-cols-fr gap-y-2">
    <div class="fi-ta-ctn py-3 px-3  divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
                    <h2 class="fi-header-heading text-xl my-2  font-bold tracking-tight text-gray-950 dark:text-white sm:text-xl">Invite User to {{ $current_workspace->name }}</h2>

                    <form action="{{ route('workspaces.invite', $current_workspace) }}" method="POST">
                        @csrf
                        <div data-field-wrapper="" class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                      <div class="flex items-center justify-between gap-x-3 ">
                       <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="email">
                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white"> Email<sup class="text-danger-600 dark:text-danger-400 font-medium">*</sup> </span>
                </label> </div>
         <div class="grid gap-y-2">
         <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                    <div class="min-w-0 flex-1">
                        <input class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3" id="email" required="required" type="text" name="email">
                    </div>

                </div>
        </div>
        <div class="fi-form-actions">
           <div class="fi-ac gap-3 flex flex-wrap items-center justify-start">
<button type="submit" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);" class="my-2fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">
    <span class="fi-btn-label"> Send Invitation </span>
</button>
    </div>

    </div>
                    </div>
                </div>


                    </form>
</div> </div>
    @endif


    <div class="grid grid-cols-1 gap-8  lg:grid-cols-2 md:grid-cols-2">

        <div class="flex items-center justify-between p-4 fi-wi-stats-overview-stat relative rounded bg-white  shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
          <div>
            <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
              Total users
            </h6>
            <span class="text-xl font-semibold">{{$member_count}}</span>

          </div>
          <div>
            <span>
              <svg class="fi-wi-stats-overview-stat-icon h-7 w-7 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path>
</svg>
            </span>
          </div>
        </div>

        <!-- Tickets card -->
        <div class="flex items-center justify-between p-4 fi-wi-stats-overview-stat relative rounded bg-white  shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
          <div>
            <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
              Total Projects
            </h6>
            <span class="text-xl font-semibold">{{$project_count}}</span>

          </div>
          <div>
            <span>
              <svg class="fi-wi-stats-overview-stat-icon h-7 w-7 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122"></path>
</svg>
            </span>
          </div>
        </div>
      </div>





</x-filament-panels::page>
