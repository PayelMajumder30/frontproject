<?php

namespace App\Http\Controllers;

use App\Models\{User, Wallet, Invoice, Ledger};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    //
    public function view(){
        $user       = Auth::user();

        // $wallet     = Wallet::where('user_id', $user->id)->first();
        // $invoices   = Invoice::where('user_id', $user->id)
        //                     ->orWhere('created_at', 'desc')
        //                     ->get();

        $wallet = Wallet::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        $totalBalance = $wallet->sum('wallet_balance');
        return view('wallet.show', compact('wallet', 'totalBalance'));
    }

    public function create() {
        return view('wallet.create');
    }

    public function store(Request $request) {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $rechargeAmount = $request->amount;
        $userId = auth()->id();

        $wallet = Wallet::where('user_id', $userId)->first();

        if($wallet) {
            $wallet->wallet_balance   += $rechargeAmount;
            $wallet->amount_added      = $rechargeAmount;
            $wallet->updated_at        = now();
            $wallet->save();  
        }
        else{            
            Wallet::create([
                'user_id'           => $userId,
                'wallet_balance'    => $rechargeAmount,  // Ensure wallet_balance is provided
                'amount_added'      => $rechargeAmount,
                'created_at'        => now(),
                'updated_at'        => now(),  // If you want to manually set the updated_at
            ]);
        }

        Ledger::create([
            'user_id'               => $userId,
            'transaction_number'    => 0, // You can use a unique ID or just 0 for wallet top-up
            'transaction_amount'    => $rechargeAmount, // the amount user recharged
            'purpose'               => 'credit',
            'is_credit'             => 1,
            'is_debit'              => 0,
        ]);

        return redirect()->route('wallet.show')->with('success', 'Wallet recharged successfully!');
    }
}
