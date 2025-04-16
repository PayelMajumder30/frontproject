<?php

namespace App\Http\Controllers;

use App\Models\{User, Wallet, Invoice, Ledger};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class LedgerController extends Controller
{
    //

    public function view() {
        //$ledgers = Ledger::with(['user', 'invoice'])
        $ledgers = Ledger::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('ledger.show', compact('ledgers'));
    }
}
