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
        // Mengambil data untuk dashboard
        $totalCustomers = Customer::count();
        $totalServices = Service::count();
        $totalTransactions = Transaction::count();
        $paymentMethod = PaymentMethod::count();

        // Mengambil pembayaran dan transaksi terbaru
        $recentPayments = Payment::with('transaction.customer')->latest()->limit(5)->get();
        $recentTransactions = Transaction::with('customer')->latest()->limit(5)->get();


        // Mengirimkan data ke view dashboard
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
