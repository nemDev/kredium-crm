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
                        @can('edit-client', $client)
                            <a href="/clients/{{$client->id}}" class="bg-yellow-600 px-4 py-1 m-2 text-white hover:bg-yellow-500">Edit</a>
                            <a href="/clients/{{$client->id}}" class="bg-red-600 px-4 py-1 m-2 text-white hover:bg-red-500 deleteButton" data-id="{{$client->id}}" data-name="{{$client->first_name}} {{$client->last_name}}">Delete</a>      
                        @endcan
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

    <div id="deleteModal" class="modal bg-indigo-100 fixed inset-0 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-xl font-bold mb-4" id="modalTitle">Are you sure you want to delete?</h2>
            <form id="deleteForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-between">
                    <button type="button" id="cancelButton" class="bg-gray-400 px-4 py-2 text-white rounded">Cancel</button>
                    <button type="submit" class="bg-red-600 px-4 py-2 text-white rounded">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var deleteButtons = document.getElementsByClassName('deleteButton')
        var deleteUrlTemplate = '{{ route('clients.destroy', ['client' => '_CLIENT_ID_']) }}';
        Array.from(deleteButtons).forEach(element => {
            element.addEventListener("click", function(e){
                e.preventDefault();
                var clientId = element.getAttribute('data-id')
                var clientName = element.getAttribute('data-name')
                console.log(parseInt(clientId))
                // Set modal title
                var modalTitle = document.getElementById('modalTitle');
                modalTitle.textContent = 'Are you sure you want to delete ' + clientName + '?';

                // Set form action to the client delete route
                var deleteForm = document.getElementById('deleteForm');
                deleteForm.action = deleteUrlTemplate.replace('_CLIENT_ID_', clientId);
                // Show the modal
                var modal = document.getElementById('deleteModal');
                modal.classList.remove('hidden');
            })
        });

        // Hide the modal if user clicks cancel
        var cancelButton = document.getElementById('cancelButton');
        cancelButton.addEventListener('click', function() {
            var modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        });
    </script>
@endsection