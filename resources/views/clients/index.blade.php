@extends('layout')
@section('title', 'Kredium CRM | All Clients page')
@section('content')
    <div class="flex justify-between my-6 bg-gray-100 p-2">
        <h1 class="text-lg flex items-center">Clients List</h1>
        <a href="{{route('clients.create')}}" class="bg-indigo-500 rounded py-2 px-6 text-white">Add new client</a>
    </div>

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
            @foreach ($clients as $client)
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
            @endforeach
        </table>
    </div>
@endsection