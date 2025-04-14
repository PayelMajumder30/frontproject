<?php

namespace App\Http\Controllers;

use App\Models\{User, Wallet, Invoice};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    //
    public function view(){
        $user       = Auth::user();

        $wallet     = Wallet::where('user_id', $user->id)->first();
        $invoices   = Invoice::where('user_id', $user->id)
                            ->orWhere('created_at', 'desc')
                            ->get();
        return view('wallet.show', compact('wallet', 'invoices'));
    }

    public function create() {
        return view('wallet.create');
    }

    public function store(Request $request) {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $wallet = Wallet::firstOrCreate(
            ['user_id'          => auth()->id()],
            ['wallet_balance'   => 0]
        );

        $wallet->wallet_balance += $request->amount;
        $wallet->save();

        return redirect()->route('wallet.show')->with('success', 'Wallet recharged successfully!');
    }
}
