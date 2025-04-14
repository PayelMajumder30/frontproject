<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Chatbox, Invoice, InvoiceItem};
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index($userId){
        $adminId    = 4;
        $user       = User::findOrFail($userId);
        $userId     = Auth::id();
    
        $chats = Chatbox::where(function ($query) use ($userId, $adminId) {
            $query->where('user_id', $userId)
                  ->where('receiver_id', $adminId);
        })->orWhere(function ($query) use ($userId, $adminId) {
            $query->where('user_id', $userId)
                  ->where('sender', 'admin');
        })->orderBy('created_at', 'asc')->get();
    
        return view('users.chat', compact('chats', 'userId', 'user'));
    }    

    public function sendmessage(Request $request){
        $request->validate([
            'message'   => 'required|string'
        ]);

        $userId = Auth::id();
        Chatbox::create([
            'user_id'       => $userId,
            'sender'        => 'user',
            'message'       => $request->message,
            'receiver_id'   => 4
        ]);
        return redirect()->back();
    }

    public function orderDetail(Request $request)
    {
        $userId = auth()->id();
    
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');
        $keyword    = $request->input('keyword');
    
        $query = Invoice::where('user_id', $userId);
    
        // Apply date filters
        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [
                $start_date . ' 00:00:00',
                $end_date . ' 23:59:59',
            ]);
        } elseif ($start_date) {
            $query->whereDate('created_at', '>=', $start_date);
        }   
        // Apply keyword filter
        if($keyword) {
            $query->where(function ($q) use ($keyword){
                    $q->where('invoice_number', 'like', "%{$keyword}%")
                        ->orWhere('total_amount', 'like', "%{$keyword}%");
            });
        }
        $invoices = $query->withCount('items as total_qty')->latest()->paginate(10);  
        return view('users.orderHistory', compact('invoices'));
    }

    public function orderView($id) {
        $userId     = auth()->id();
        $invoice    = Invoice::with(['items.product'])
                        ->where('user_id', $userId)
                        ->where('id', $id)
                        ->firstOrFail();

        return view('users.orderView', compact('invoice'));
    }
    
}