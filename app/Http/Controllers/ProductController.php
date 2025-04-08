<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\{User, Product, Invoice, InvoiceItem};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'product_id.*'  => 'required|exists:products,id',
            'quantity.*'    => 'required|integer|min:1',
            'price.*'       => 'required|numeric|min:0',
            'total.*'       => 'required|numeric|min:0',
        ]);

        // 
        $user = Auth::user();
        $totalAmount = 0;

        foreach ($request->product_id as $index => $productId) {
            $quantity       = $request->quantity[$index];
            $price          = $request->price[$index];
            $total          = $request->total[$index];
            $totalAmount    += $total;
        }

        $invoiceNumber = date('Ymd'). '-' . rand(100, 999);
        $invoice = Invoice::create([
            'user_id'       => $user->id,
            'user_name'     => $user->name,
            'address'       => $user->address ?? '',
            'email'         => $user->email,
            'total_amount'  => $totalAmount,
            'invoice_number'=> $invoiceNumber,
        ]);

        foreach ($request->product_id as $index => $productId) {
            $product = Product::find($productId);
            $itemsPeramount =  $product ? $product->price : 0 ;
            InvoiceItem::create([
                'invoice_id'        => $invoice->id,
                'product_id'        => $productId,
                'quantity'          => $request->quantity[$index],
                'amount'            => $request->total[$index],
                'items_per_amount'  => $itemsPeramount,
            ]);
        }

        return redirect()->back()->with('success', 'Invoice submitted successfully.');
    }
    
}
