<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalCustomers = Customer::count();
        $totalServices = Service::count();
        $totalTransactions = Transaction::count();
        $paymentMethod = PaymentMethod::count();

        $recentPayments = Payment::latest()->limit(5)->get();
        $recentTransactions = Transaction::latest()->limit(5)->get();

        return view('home', [
            'totalCustomers' => $totalCustomers,
            'totalServices' => $totalServices,
            'totalTransactions' => $totalTransactions,
            'recentPayments' => $recentPayments,
            'recentTransactions' => $recentTransactions,
            'paymentMethod' => $paymentMethod,
        ]);
    }
}
