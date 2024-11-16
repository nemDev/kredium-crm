@extends('layout')
@section('title', 'Kredium CRM | Clients edit page')
@section('content')
<h1 class="text-center my-4">Edit client details</h1>
<form action="{{ route('clients.update', $client->id) }}" method="post" class="flex justify-center flex-col w-2/5 mx-auto">
    @csrf
    <!-- First name field -->
    <div class="my-2 w-full">
        <input 
            type="text" 
            name="first_name" 
            id="first_name" 
            @class(['border', 'rounded', 'w-full', 'p-2', 'border-red-500' => $errors->has('first_name')]) 
            placeholder="First Name" 
            value="{{ $client->first_name }}">
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
            value="{{ $client->last_name }}">
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
            value="{{ $client->email }}">
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
            value="{{ $client->phone }}">
        @error('phone')
            <span 
                class="font-light text-red-500">
                {{$message}}
            </span>
        @enderror
    </div>

    <!-- Cash loan -->
    <h2 class="text-center my-4">Cash loan</h2>
    <!-- Cash loan amount field -->
    <div class="my-2 w-full">
        <input 
            type="text" 
            name="cashLoan[amount]" 
            id="cashLoanAmount" 
            @class(['border', 'rounded', 'w-full', 'p-2', 'border-red-500' => $errors->has('cashLoanAmount')]) 
            placeholder="Cash Loan Amount" 
            value="{{ $client->cashLoan && $client->cashLoan->amount ? $client->cashLoan->amount : '' }}">
        @error('cashLoanAmount')
            <span 
                class="font-light text-red-500">
                {{$message}}
            </span>
        @enderror
    </div>
    <!-- Home loan -->
    <h2 class="text-center my-4">Home loan</h2>
    <!-- Property Value -->
    <div class="my-2 w-full">
        <input 
            type="text" 
            name="homeLoan[propertValue]" 
            id="homeLoanPropertyValue" 
            @class(['border', 'rounded', 'w-full', 'p-2', 'border-red-500' => $errors->has('homeLoan[propertValue]')]) 
            placeholder="Propert value" 
            value="{{ $client->cashLoan && $client->cashLoan->property_amount ? $client->cashLoan->property_amount : '' }}">
        @error('homeLoan[propertValue]')
            <span 
                class="font-light text-red-500">
                {{$message}}
            </span>
        @enderror
    </div>
    <!-- Property Value -->
    <div class="my-2 w-full">
        <input 
            type="text" 
            name="homeLoan[downPaymentAmount]" 
            id="homeLoanDownPaymentAmount" 
            @class(['border', 'rounded', 'w-full', 'p-2', 'border-red-500' => $errors->has('homeLoan[downPaymentAmount]')]) 
            placeholder="Propert value" 
            value="{{ $client->homeLoan && $client->homeLoan->down_payment_amount ? $client->cashLoan->down_payment_amount : '' }}">
        @error('homeLoan[downPaymentAmount]')
            <span 
                class="font-light text-red-500">
                {{$message}}
            </span>
        @enderror
    </div>
    <div class="my-6 w-full text-center">
        <button type="submit" class="bg-green-100 py-2 px-6 border rounded hover:bg-green-700 hover:text-white">Save</button>
    </div>
</form>
@endsection