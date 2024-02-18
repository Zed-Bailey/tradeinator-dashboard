<div>
{{--    {{$accounts}}--}}
    @if($accounts == null)
        <p>Failed to load accounts</p>
        <button wire:click="reload">Reload</button>
    @else
        <h1 class="text-2xl">Accounts</h1>
        <div class="flex justify-items-start flex-wrap gap-2">
            @foreach($accounts as $acc)

                <a href="/accounts/{{$acc->id}}" wire:click class="border-2 border-slate-500 p-2 rounded-lg hover:shadow-lg">
                    {{$acc->id}}
                </a>

            @endforeach
        </div>
    @endif

</div>
