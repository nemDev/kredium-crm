<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientIds = Client::select('id')
                            ->where(['adviser_id' => Auth::user()->id])
                            ->where(function($query) {
                                $query->whereHas('cashLoan')->orWhereHas('homeLoan');
                            })
                            ->pluck('id')
                            ->toArray();
        
        $cashLoans = DB::table('cash_loans')
                        ->select(
                            'type', 
                            'amount', 
                            'created_at'
                            )
                        ->whereIn('client_id', $clientIds)
                        ->get();

        $homeLoans = DB::table('home_loans')
                        ->select(
                            'type', 
                            DB::raw("(property_amount - down_payment_amount) as amount"),
                            'created_at'
                            )
                        ->whereIn('client_id', $clientIds)
                        ->get();

        $reportsArray = $cashLoans->merge($homeLoans);

        $sortedReports = $reportsArray->sortBy('created_at', SORT_REGULAR, true);
        return view('report.index', ['reports' => $sortedReports]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export(){
        $clientIds = Client::select('id')
                            ->where(['adviser_id' => Auth::user()->id])
                            ->where(function($query) {
                                $query->whereHas('cashLoan')->orWhereHas('homeLoan');
                            })
                            ->pluck('id')
                            ->toArray();
        
        $cashLoans = DB::table('cash_loans')
                        ->select(
                            'type', 
                            'amount', 
                            'created_at'
                            )
                        ->whereIn('client_id', $clientIds)
                        ->get();

        $homeLoans = DB::table('home_loans')
                        ->select(
                            'type', 
                            DB::raw("(property_amount - down_payment_amount) as amount"),
                            'created_at'
                            )
                        ->whereIn('client_id', $clientIds)
                        ->get();

        $reportsArray = $cashLoans->merge($homeLoans);

        $sortedReports = $reportsArray->sortBy('created_at', SORT_REGULAR, true);
        
        $csvData[] = ['Product type', 'Product value', 'Creation date'];

        foreach ($sortedReports as $report) {
            $csvData[] = [
                $report->type,
                $report->amount,
                $report->created_at
            ];
        }
        // Create the CSV file in memory using fopen and fputcsv
        $handle = fopen('php://output', 'w');
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        // Set headers for the CSV download
        $filename = 'report_' . time();
        return response()->stream(function() use ($handle) {
            fclose($handle);
        }, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $filename, 
        ]);
    }
}
