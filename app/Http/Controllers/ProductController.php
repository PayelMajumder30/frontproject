<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

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
}
