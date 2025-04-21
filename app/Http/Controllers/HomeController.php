<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Member;
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
        $userCount = null;

        if (auth()->user()->role == 'superadmin') {
            $userCount = User::count();
        }

        $productCount = Product::count();

        return view('home', compact(
            'userCount',
            'productCount',
        ));
    }

    public function blank()
    {
        return view('layouts.blank-page');
    }
}
