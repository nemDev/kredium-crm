@extends('layout')
@section('title', 'Kredium CRM | Clients create page')
@section('content')
<h1 class="text-2xl text-center my-4 py-4">Create client page</h1>
<form action="{{ route('clients.store') }}" method="post" class="flex justify-center flex-col w-2/5 mx-auto">
    @csrf
    <!-- First name field -->
    <div class="my-2 w-full">
        <input 
            type="text" 
            name="first_name" 
            id="first_name" 
            @class(['border', 'rounded', 'w-full', 'p-2', 'border-red-500' => $errors->has('first_name')]) 
            placeholder="First Name" 
            value="{{ old('first_name') }}">
        @error('first_name')
            <span 
                class="font-light text-red-500">
                {{$message}}
            </span>
        @enderror
    </div>
    <!-- Last name field -->
    <div class="my-2 w-full">
        <input 
            type="text" 
            name="last_name" 
            id="last_name" 
            @class(['border', 'rounded', 'w-full', 'p-2', 'border-red-500' => $errors->has('last_name')]) 
            placeholder="Last Name" 
            value="{{ old('last_name') }}">
        @error('last_name')
            <span 
                class="font-light text-red-500">
                {{$message}}
            </span>
        @enderror
    </div>
    <!-- Email field -->
    <div class="my-2 w-full">
        <input 
            type="email" 
            name="email" 
            id="email" 
            @class(['border', 'rounded', 'w-full', 'p-2', 'border-red-500' => $errors->has('email')]) 
            placeholder="Email" 
            value="{{ old('email') }}">
        @error('email')
            <span 
                class="font-light text-red-500">
                {{$message}}
            </span>
        @enderror
    </div>
    <!-- Phone field -->
    <div class="my-2 w-full">
        <input 
            type="text" 
            name="phone" 
            id="phone" 
            @class(['border', 'rounded', 'w-full', 'p-2', 'border-red-500' => $errors->has('phone')]) 
            placeholder="Phone" 
            value="{{ old('phone') }}">
        @error('phone')
            <span 
                class="font-light text-red-500">
                {{$message}}
            </span>
        @enderror
    </div>
    <div class="my-6 w-full text-center">
        <button type="submit" class="bg-emerald-500 py-2 px-6 border rounded hover:bg-emerald-600 hover:text-white text-white">Save</button>
    </div>
</form>
@endsection