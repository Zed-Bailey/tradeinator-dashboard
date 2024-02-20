<div class="w-full h-full">

    <h2 class="text-2xl">Account Transactions</h2>
    <div class="w-full flex justify-center text-red-500 text-lg">
        @error('transactions_error') {{$message}} @enderror
    </div>

    <div class="overflow-scroll">
        <table class="max-w-7xl text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">transaction id</th>
                <th scope="col" class="px-6 py-3">time</th>
                <th scope="col" class="px-6 py-3">type</th>
                <th scope="col" class="px-6 py-3">reason</th>
                <th scope="col" class="px-6 py-3">instrument</th>
                <th scope="col" class="px-6 py-3">price</th>
                <th scope="col" class="px-6 py-3">units</th>
                <th scope="col" class="px-6 py-3">P/L</th>
                <th scope="col" class="px-6 py-3">commission</th>
                <th scope="col" class="px-6 py-3">account balance</th>

            </tr>

            </thead>

            <tbody>

                @foreach($data as $t)
                    <tr  class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{$t->id}}</td>
                        <td class="px-6 py-4">{{date('d/m/y H:i', strtotime($t->time))}}</td>
                        <td class="px-6 py-4">{{$t->type}}</td>
                        <td class="px-6 py-4">{{$t->reason ?? ""}}</td>
                        <td class="px-6 py-4">{{$t->instrument ?? ""}}</td>
                        <td class="px-6 py-4">{{$t->price ?? ""}}</td>
                        <td class="px-6 py-4">{{$t->units ?? ""}}</td>
                        <td class="px-6 py-4">{{$t->pl ?? ""}}</td>
                        <td class="px-6 py-4">{{$t->commission ?? ""}}</td>
                        <td class="px-6 py-4">{{$t->accountBalance ?? ""}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
