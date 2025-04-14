<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Product, Invoice, InvoiceItem};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function dashboardview(){
        $totalUsers = Invoice::distinct('user_id')->count('user_id');

        // Total invoices
        $totalInvoices = Invoice::count();

        // Total amount from all invoices
        $totalAmount = Invoice::sum('total_amount');
        $totalProduct = Product::count();
        return view('dashboard', compact('totalUsers', 'totalInvoices', 'totalAmount', 'totalProduct'));
    }

    public function flotview(){
        return view('flot');
    }

    public function morrisview(){
        return view('morris');
    }

    public function tableview(){
        return view('table');
    }

    public function formsview(){
        return view('forms');
    }

    public function panelswellsview(){
        return view('panels-wells');
    }

    public function notificationsview(){
        return view('notifications');
    }

    public function typographyview(){
        return view('typography');
    }

}
