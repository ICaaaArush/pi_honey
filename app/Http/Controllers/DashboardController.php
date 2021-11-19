<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\MainProduct;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    public function Dashboard($value='')
    {
        $profits = 0;

        $profits_this_month = 0;

        $cost = 0;

        $orderdetail = OrderDetail::all();

        $this_month = Carbon::now()->format('m');

        $orderdetail_this_month = OrderDetail::whereMonth('created_at',$this_month)->get();

        $cost_this_month = Product::whereMonth('created_at',$this_month)->get();

        $order_this_month = Order::whereMonth('created_at',$this_month)->count();

        foreach ($orderdetail as $detail) {

            $prod = MainProduct::where('id', $detail->main_product_id)->first();

            $profit = $prod->price - $prod->cost;

            $profits += $profit * $detail->quantity;
        }

        foreach ($orderdetail_this_month as $detail) {

            $prod = MainProduct::where('id', $detail->main_product_id)->first();

            $profit = $prod->price - $prod->cost;

            $profits_this_month += $profit * $detail->quantity;
        }

        foreach ($cost_this_month as $detail) {

            $cost = $detail->costing;

            $cost += $cost;
        }

        $customers = User::where('role','user')->latest()->limit(10)->get();

        $top_products = MainProduct::with('orders')->limit(10)->get();

        $orders = Order::latest()->limit(10)->get();

        return view('front.index',compact('profits','profits_this_month','cost','order_this_month','top_products','customers','orders'));
    }
}
