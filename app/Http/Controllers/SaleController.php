<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('customer_name', 'like', '%' . $request->search . '%');
        }

        $sales = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        $members = Member::all();
        return view('sales.create', compact('products', 'members'));
    }

    public function confirmationStore(Request $request) {
        $filteredQuantities = [];

        foreach ($request->input('quantities', []) as $key => $value) {
            if ($value > 0) {
                $filteredQuantities[$key] = $value;
            }
        }

        $products = Product::whereIn('id', array_keys($filteredQuantities))->get();
        $totalAmount = $products->sum(function ($product) use ($filteredQuantities) {
            return $product->price * $filteredQuantities[$product->id];
        });

        $members = Member::all();

        return view('sales.confirmation', compact('products', 'totalAmount', 'members', 'filteredQuantities'));
    }

    public function store(Request $request)
    {
        $productData = json_decode($request->input('product_data'), true);
        $totalPay = $request->input('total_pay');
        $totalAmount = $request->input('total_amount');
        $invoiceNumber = 'INV-' . strtoupper(Str::random(8));

        $memberName = $invoiceNumber;
        $memberId = null;

        if (!empty($request->member_id)) {
            $member = Member::find($request->member_id);
            if ($member) {
                $memberId = $member->id;
                $memberName = $member->name;
            }
        }

        if ($request->is_member == 'yes') {
            $products = $productData;
            return view('sales.member', compact('member', 'products', 'totalAmount', 'totalPay'));
        }

        if ($request->use_point == 1) {
            $totalAmount = $totalAmount - $request->total_point;
            Member::where('id', $memberId)->decrement('points', $request->total_point);
        } else {
            $addPoint = $totalAmount / 100;
            Member::where('id', $memberId)->increment('points', $addPoint);
        }

        Sale::create([
            'id' => Str::uuid(),
            'invoice_number' => $invoiceNumber,
            'customer_name' => $memberName,
            'user_id' => Auth::user()->id,
            'member_id' => $memberId,
            'product_data' => json_encode($productData),
            'total_amount' => $totalAmount,
            'payment_amount' => $totalPay,
            'change_amount' => $totalPay - $totalAmount,
            'notes' => '-',
        ]);

        foreach ($productData as $product) {
            Product::where('id', $product['id'])->decrement('quantity', $product['quantity']);
        }

        if ($request->use_point == 1) {
            $totalAmount = $totalAmount + $request->total_point;
            $discount = $request->total_point;
        } else {
            $discount = 0;
        }

        return view('sales.invoice', compact('invoiceNumber', 'totalAmount', 'totalPay', 'memberName', 'memberId', 'productData', 'discount'));
    }

    public function showInvoice($id)
    {
        $sale = Sale::where('id', $id)->firstOrFail();

        $productData = json_decode($sale->product_data, true);

        $totalProductPrice = array_reduce($productData, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $discount = $totalProductPrice - $sale->total_amount;

        // Hitung poin yang didapat (jika transaksi dilakukan oleh member)
        $points = 0;
        if ($sale->member_id) {
            // Misal: setiap 10.000 rupiah = 1 poin
            $points = floor(($sale->total_amount + $discount) / 100);
        }

        return view('sales.invoice-detail', [
            'invoiceNumber' => $sale->invoice_number,
            'memberName'    => $sale->customer_name,
            'memberId'      => $sale->member_id,
            'productData'   => $productData,
            'totalAmount'   => $sale->total_amount,
            'totalPay'      => $sale->payment_amount,
            'changeAmount'  => $sale->change_amount,
            'discount'      => $discount,
            'createdAt'     => $sale->created_at,
            'points'        => $points
        ]);
    }

    

    public function show(Sale $sale)
    {
        $sale->product_data = json_decode($sale->product_data, true);
        return view('sales.show', compact('sale'));
    }
}
