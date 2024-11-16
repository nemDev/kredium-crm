<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdviserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Adviser $adviser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adviser $adviser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adviser $adviser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adviser $adviser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function login(Request $request)
    {
        $data = $request->validate(
            [
                'password' => 'required',
                'email' => 'required|email'
            ]
        );
        
        if(Auth::attempt($data)){
            //Redirect to dashboard
            return redirect(route('dashboard'));
        }
        
        //Validation failed, redirect to login page with message
        return redirect(route('login'))->with([
            'error' => 'Wrong credentials. Please check email and password and try again.',
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('home'));
    }
}
