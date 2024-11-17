@extends('layout')
@section('title', 'Kredium CRM | Report page')

@section('content')
    <div class="my-4 flex justify-end">
        <form action="{{route('report.export')}}" method="POST">
            @csrf
            <button type="submit" class="bg-green-600 py-2 px-6 border rounded hover:bg-green-700 text-white">Export to CSV</button>
        </form>
        
    </div>
    <h1 class="text-2xl text-center my-4 py-4">View report page</h1>
    <div>

        <table class="w-full">
            <tr class="border border-2 border-gray-400 bg-gray-200">
                <th class="border p-3 border-gray-400">Product type</th>
                <th class="border p-3 border-gray-400">Product value</th>
                <th class="border p-3 border-gray-400">Creation date</th>
            </tr>
            @forelse ($reports as $report)
                <tr scope="row" class="border text-center">
                    <td class="border py-2">{{ $report->type }}</td>
                    <td class="border py-2">{{ $report->amount }}</td>
                    <td class="border py-2">{{ $report->created_at }}</td>
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