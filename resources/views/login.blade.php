@extends('layout')
@section('title', 'Kredium CRM | Login Page')
    
@section('content')
    @if (session('error'))
    <div class="bg-red-100 border rounded p-3 my-2">
        {{session('error')}}
    </div>
    @endif
    <h1 class="text-center my-4 text-2xl">Adviser's Login Form</h1>
    <form action="{{ route('adviser.login') }}" method="post" class="flex justify-center flex-col w-2/5 mx-auto">
        @csrf
        <!-- Email field -->
        <div class="my-2 w-full">
            <input 
                type="email" 
                name="email" 
                id="email" 
                @class(['border', 'rounded', 'w-full', 'p-2', 'border-red-500' => $errors->has('email') || session('email')]) 
                placeholder="Email" 
                value="{{ session('email') ? session('email') : old('email') }}">
            @error('email')
                <span 
                    class="font-light text-red-500">
                    {{$message}}
                </span>
            @enderror
        </div>
        <!-- Password field -->
        <div class="my-2 w-full">
            <input 
                type="password" 
                name="password" 
                id="password" 
                @class(['border', 'rounded', 'w-full', 'p-2', 'border-red-500' => $errors->has('password') || session('password')]) 
                placeholder="Password" 
                value="{{  session('password') ? session('password') : old('password') }}">
            @error('password')
                <span 
                    class="font-light text-red-500">
                    {{$message}}
                </span>
            @enderror
        </div>
        <div class="my-6 w-full text-center">
            <button type="submit" class="bg-emerald-500 py-2 px-6 border rounded hover:bg-emerald-600 hover:text-white text-white">Login</button>
        </div>
    </form>
    
@endsection