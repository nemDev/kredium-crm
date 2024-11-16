<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clients.index', ['clients' => Client::orderBy('created_at', 'desc')->with(['cashLoan', 'homeLoan'])->get()  ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:clients',
            'phone' => 'required'
        ]);
        $data['adviser_id'] = Auth::user()->id;
        $client = Client::create($data);
        if(!$client){
            return redirect(route('clients.index'))->with('error', 'Something went wrong. Try again later.');
        }
        return redirect(route('clients.index'))->with('success', 'New client created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $client->load(['cashLoan', 'homeLoan']);
        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'cashLoan' => [
                'amount' => ''
            ],
            'homeLoan' => [
                'propertyValue' => '',
                'downPaymentAmount' => ''
            ]
        ]);
        dd($data);
        $client->first_name = $data['first_name'];
        $client->last_name = $data['last_name'];
        $client->phone = $data['phone'];

        if($data['cashLoan']['amount']){
            
        }
        $client->save($data);

        return redirect(route('clients.index'))->with('success', 'Client data updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
