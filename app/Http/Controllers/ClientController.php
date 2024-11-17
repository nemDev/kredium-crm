<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        //Check if adviser can access to edit form client
        if(!Gate::allows('edit-client', $client)){
            abort(403);
        }
        
        $client->load(['cashLoan', 'homeLoan']);
        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //Check if adviser can update client
        if(!Gate::allows('edit-client', $client)){
            abort(403);
        }
        //Validation rules
        $validationRules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'cashLoan.amount' => 'nullable|numeric',
            'homeLoan.propertyValue' => 'nullable|numeric',
            'homeLoan.downPaymentAmount' => 'nullable|numeric'
        ];
        //Check validation for email
        if($client->email != $request->input('email')){
            $validationRules['email'] = 'required|unique:clients';
        }
        $data = $request->validate($validationRules);

        $client->first_name = $data['first_name'];
        $client->last_name = $data['last_name'];
        $client->phone = $data['phone'];
        if(isset($data['email'])){
            $client->email = $data['email'];
        }

        $client->save($data);

        // Handle cashLoan update or removal
        if (isset($data['cashLoan']['amount']) && $data['cashLoan']['amount'] > 0) {
            //dd((float)$data['cashLoan']['amount']);
            // If cashLoan amount is provided, set or update the relationship
            $client->cashLoan()->updateOrCreate(
                ['client_id' => $client->id],
                ['amount' => (float) $data['cashLoan']['amount'], 'type' => 'Cash loan']
            );
        } else {
            // If no amount is provided, remove the cashLoan relationship
            if ($client->cashLoan) {
                $client->cashLoan()->delete();
            }
        }
        // Handle homeLoan update or removal 'downPaymentAmount'
        if ((isset($data['homeLoan']['propertyValue']) && $data['homeLoan']['propertyValue'] > 0) || (isset($data['homeLoan']['downPaymentAmount']) && $data['homeLoan']['downPaymentAmount'] > 0)) {
            // If homeLoan propertyValue or downPaymentAmount is provided, set or update the relationship
            $client->homeLoan()->updateOrCreate(
                ['client_id' => $client->id],
                ['property_amount' => (float) $data['homeLoan']['propertyValue'],'down_payment_amount' => (float) $data['homeLoan']['downPaymentAmount'], 'type' => 'Home loan']
            );
        } else {
            // If no amount is provided, remove the homeLoan relationship
            if ($client->homeLoan) {
                $client->homeLoan()->delete();
            }
        }

        return redirect(route('clients.index'))->with('success', 'Client data updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //Check if adviser can delete client
        if(!Gate::allows('edit-client', $client)){
            abort(403);
        }
        
        if($client->delete()){
            return redirect(route('clients.index'))->with('success', 'Client was successfully deleted'); 
        }

        return redirect(route('clients.index'))->with('error', 'Something went wrong. The delete action did\'t perform.');
    }
}
