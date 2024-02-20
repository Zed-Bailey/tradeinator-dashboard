<div class="min-h-72">
{{--    {{json_encode($data, JSON_PRETTY_PRINT)}}--}}

    <h2 class="text-2xl mt-5 mb-2">Current Open Trades</h2>
    @if($data == null)
        <p>loading</p>
    @else
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">id</th>
                <th scope="col" class="px-6 py-3">instrument</th>
                <th scope="col" class="px-6 py-3">price</th>
                <th scope="col" class="px-6 py-3">open time</th>
                <th scope="col" class="px-6 py-3">initial units</th>
                <th scope="col" class="px-6 py-3">current units</th>
                <th scope="col" class="px-6 py-3">state</th>
                <th scope="col" class="px-6 py-3">unrealised P/L</th>
            </tr>

        </thead>

        <tbody>
            @if(!empty($data->trades))
                @foreach($data->trades as $trade)
                    <tr  class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{$trade->id}}</td>
                        <td class="px-6 py-4">{{$trade->instrument}}</td>
                        <td class="px-6 py-4">{{$trade->price}}</td>
                        <td class="px-6 py-4">{{$trade->openTime}}</td>
                        <td class="px-6 py-4">{{$trade->initialUnits}}</td>
                        <td class="px-6 py-4">{{$trade->currentUnits}}</td>
                        <td class="px-6 py-4">{{$trade->state}}</td>
                        <td class="px-6 py-4">{{$trade->unrealizedPL}}</td>
                    </tr>
                @endforeach
            @endif

            @error('loading_error')
                <tr>{{$message}}</tr>
            @enderror
        </tbody>
    </table>
    @endif
</div>
