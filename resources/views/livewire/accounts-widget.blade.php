<div>
{{--    {{$accounts}}--}}
    @if($accounts == null)
        <p>Failed to load accounts</p>
        <button wire:click="reload">Reload</button>
    @else
        <ul class="list-none">
            @foreach($accounts as $acc)
                <li>

                    <span>{{$acc->id}}</span>
                    <a href="/accounts/{{$acc->id}}" wire:click> >> </a>
                </li>
            @endforeach
        </ul>
    @endif

</div>
