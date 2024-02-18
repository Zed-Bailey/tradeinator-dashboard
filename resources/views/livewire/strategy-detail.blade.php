<div class="w-full max-w-7xl p-5">
    <a wire:click href="/" class="border-b-2 hover:border-b-slate-900"><- Back</a>

    <h1 class="text-xl mt-5">Update Strategy Properties</h1>

    <form class="max-w-2xl mt-3" wire:submit="submitConfigUpdate">
        {{$this->form}}

        <button class="p-2 rounded-lg bg-blue-500 text-white w-full mt-5">Update</button>
    </form>


    <br/><br/><br/>

    <h1 class="text-xl">Update Raw Json Config</h1>
    <form wire:submit="updateRawConfig" class="min-h-72">
        <textarea wire:model="rawJsonConfig" class="w-full min-h-72 h-72"></textarea>
        <button class="p-2 rounded-lg bg-blue-500 text-white w-full mt-5">Update</button>
    </form>

</div>
