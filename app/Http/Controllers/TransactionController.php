<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index($week = null)
    {
        $transactions = Transaction::orderByDesc('id');

        if(!empty($week)) {
            $transactions = $transactions->select('*',DB::raw("(COUNT(*)) as count"), DB::raw("DAYNAME(created_date) as dayname"))
                        ->whereBetween('created_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                        ->whereYear('created_date', date('Y'))
                        ->groupBy('dayname');
        }

        $transactions = $transactions->get();

        return view('pages.transactions.index', compact('transactions'));
    }
}
