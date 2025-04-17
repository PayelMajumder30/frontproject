<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\{User, Product, Invoice, InvoiceItem, Wallet, Ledger};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function view($id) {
        $user       = User::findOrFail($id);
        $products   = Product::all();
        return view('product.view', compact('user', 'products'));
    }

    public function getProductPrice($id){
        $product    = Product::find($id);
        return response()->json($product); 
    }

    public function pdfGenerate(Request $request){
        $user = User::findOrFail($request->user_id);
        $selectedProducts = json_decode($request->product_data, true);
    
        $products = collect();
    
        foreach ($selectedProducts as $item) {
            $product = Product::find($item['id']);
            if ($product) {
                $product->selected_qty      = $item['qty'];
                $product->selected_price    = $item['price'];
                $product->total             = $item['qty'] * $item['price'];
                $products->push($product);
            }
        }
    
        $subtotal = $products->sum('total');
    
        $pdf = Pdf::loadView('product.invoice', compact('user', 'products', 'subtotal'));
        return $pdf->download('invoice_' . $user->name . '.pdf');
    }

    public function submit(Request $request){
       // dd($request->all());

        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'product_id.*'  => 'required|exists:products,id',
                'quantity.*'    => 'required|integer|min:1',
                'price.*'       => 'required|numeric|min:0',
                'total.*'       => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = Auth::user();
            $totalAmount = 0;

            foreach ($data['product_id'] as $index => $productId) {
                $quantity    = $data['quantity'][$index];
                $price       = $data['price'][$index];
                $total       = $data['total'][$index];
                $totalAmount += $total;
            }

            $wallet = Wallet::where('user_id', $user->id)->first();

            if(!$wallet || $wallet->wallet_balance < $totalAmount) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance, please recharge your balance']);
            }

            $wallet->wallet_balance -= $totalAmount;
            $wallet->save();

            $invoiceNumber = date('Ymd') . '-' . rand(100, 999);
            $invoice = Invoice::create([
                'user_id'        => $user->id,
                'user_name'      => $user->name,
                'address'        => $user->address ?? '',
                'email'          => $user->email,
                'total_amount'   => $totalAmount,
                'invoice_number' => $invoiceNumber,
            ]);
            Ledger::create([
                'user_id'               => $invoice->user_id,
                'transaction_number'    => $invoice->invoice_number,
                'transaction_amount'    => $invoice->total_amount,
                'purpose'               => 'debit',
                'is_credit'             => 0,
                'is_debit'              => 1,
            ]);

            foreach ($data['product_id'] as $index => $productId) {
                $product = Product::find($productId);
                $itemsPeramount = $product ? $product->price : 0;
                InvoiceItem::create([
                    'invoice_id'       => $invoice->id,
                    'product_id'       => $productId,
                    'quantity'         => $data['quantity'][$index],
                    'amount'           => $data['total'][$index],
                    'piece_per_amount' => $itemsPeramount,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Invoice submitted successfully'
            ]);
        } catch (\Throwable $e) {
            // Optional: log the actual error to laravel.log
            \Log::error('Invoice Submit Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error'   => $e->getMessage() // you can hide this in production
            ], 500);
        }
    }

    public function index(Request $request) {
        //dd($request->all());
        $keyword    = $request->keyword ?? '';
        $start_date = $request->start_date ?? '';
        $end_date   = $request->end_date ?? '';
        $query      = Invoice::query();

        //search by keyword
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('user_name', 'like', '%' . $keyword . '%')
                  ->orWhere('total_amount', 'like', '%' . $keyword . '%')
                  ->orWhere('invoice_number', 'like', '%' . $keyword . '%');
            });
        }
    
        // Optional: filter by date
        if ($start_date && $end_date) {
            $query->when($start_date && $end_date, function($q) use ($start_date, $end_date){
                $q->where('created_at', '>=', $start_date)
                   ->where('created_at', '<=', $end_date); 
            });           
        } else if($start_date) {
            $query->when($start_date, function($q) use ($start_date) {
                $q->where('created_at', '>=', $start_date);
            });
        }
        //dd($query);
        $subtotal   = $query->sum('total_amount');
        $data       = $query->latest('id')->paginate(10);
        return view ('product.list', compact('data', 'subtotal'));
    }
}
