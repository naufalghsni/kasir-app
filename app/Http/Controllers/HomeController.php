<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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
        $userCount = auth()->user()->role === 'superadmin' ? User::count() : null;
        $productCount = Product::count();
        $salesCount = Sale::count();
        $memberCount = Member::count();

        // Ambil jumlah penjualan per hari di bulan ini
        $salesPerDay = Sale::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Pisahkan tanggal & totalnya ke array biasa
        $salesDates = $salesPerDay->pluck('date')->map(function($d) {
            return Carbon::parse($d)->format('d M');
        });
        $salesTotals = $salesPerDay->pluck('total');

        // Kirimkan data ke view
        return view('home', compact(
            'userCount',
            'productCount',
            'salesCount',
            'memberCount',
            'salesDates',
            'salesTotals'
        ));
    }

    public function blank()
    {
        return view('layouts.blank-page');
    }
}
