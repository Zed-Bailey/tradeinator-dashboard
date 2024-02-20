<div class="w-full max-w-7xl p-5">
    <div class="flex justify-between items-center">
        <a wire:click href="/" class="border-b-2 hover:border-b-slate-900"><- Back</a>
        <div>
            <button wire:click="duplicateStrategy" class="hover:bg-blue-500 hover:text-white font-bold p-2 rounded-lg transition-all duration-200">Duplicate</button>
{{--            <button wire:click="deleteStrategy" class="hover:bg-red-500 hover:text-white font-bold p-2 rounded-lg transition-all duration-200">Delete</button>    --}}
        </div>
    </div>



    <div class="flex justify-start items-baseline gap-4">
        <h1 class="text-3xl mt-4">{{$strategy->StrategyName}}</h1>
        {{$this->editStrategyNameAction}}
    </div>
    <span class="inline-flex gap-5">
        <span class="font-bold text-gray-400">{{$strategy->Slug}}</span>

        <span class="font-light">{{date('r', strtotime($strategy->LastUpdated))}}</span>
    </span>



    <h2 class="text-xl mt-5">Update Strategy Properties</h2>

    <form class="max-w-2xl mt-3" wire:submit="submitConfigUpdate">
        {{$this->form}}

        <button class="p-2 rounded-lg bg-blue-500 text-white w-full mt-5">Update</button>
    </form>


    <br/><br/><br/>

    <h2 class="text-xl">Update Raw Json Config</h2>
    <form wire:submit="updateRawConfig" class="min-h-72">
        <textarea wire:model="rawJsonConfig" class="w-full min-h-72 h-72"></textarea>
        <button class="p-2 rounded-lg bg-blue-500 text-white w-full mt-5">Update</button>
    </form>



    <x-filament-actions::modals />
</div>
