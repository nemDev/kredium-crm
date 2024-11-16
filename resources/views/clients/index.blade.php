@extends('layout')
@section('title', 'Kredium CRM | All Clients page')

@section('content')
    <h1 class="text-2xl text-center my-4 py-4">View all clients page</h1>

    @if (session('success'))
    <div class="bg-green-100 border rounded p-3 my-2">
        {{session('success')}}
    </div>
    @endif

    @if (session('error'))
    <div class="bg-red-100 border rounded p-3 my-2">
        {{session('error')}}
    </div>
    @endif
    <div>

        <table class="w-full">
            <tr class="border border-2 border-gray-400 bg-gray-200">
                <th class="border p-3 border-gray-400">First Name</th>
                <th class="border p-3 border-gray-400">Last Name</th>
                <th class="border p-3 border-gray-400">Email</th>
                <th class="border p-3 border-gray-400">Phone</th>
                <th class="border p-3 border-gray-400">Cash loan</th>
                <th class="border p-3 border-gray-400">Home loan</th>
                <th class="border p-3 border-gray-400">Actions</th>
            </tr>
            @forelse ($clients as $client)
                <tr scope="row" class="border text-center">
                    <td class="border py-2">{{ $client->first_name }}</td>
                    <td class="border py-2">{{ $client->last_name }}</td>
                    <td class="border py-2">{{ $client->email }}</td>
                    <td class="border py-2">{{ $client->phone }}</td>
                    <td class="border py-2">
                        @if ($client->cashLoan)
                            <span>Yes</span>
                        @else
                            <span>No</span>
                        @endif
                    </td>
                    <td class="border py-2">
                        @if ($client->homeLoan)
                            <span>Yes</span>
                        @else
                            <span>No</span>
                        @endif
                    </td>
                    <td class="border py-2">
                        <a href="/clients/{{$client->id}}" class="bg-yellow-600 px-4 py-1 m-2 text-white hover:bg-yellow-500">Edit</a>
                        <a href="/clients/{{$client->id}}" class="bg-red-600 px-4 py-1 m-2 text-white hover:bg-red-500">Delete</a>
                    </td>
                </tr>  
            @empty
                <tr scope="row" class="border text-center">
                    <td colspan="7" class="py-4 font-bold">
                        No data to display.
                    </td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection