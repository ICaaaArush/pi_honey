<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\DeliveryCompany;
use App\Models\Category;
use App\Models\MainProduct;
use App\Models\SupplierDetail;

class CommonController extends Controller
{
    public function Logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function DeleteMainProduct($id)
    {
        MainProduct::where('id', $id)->delete();

        return redirect()->back();
    }
    public function DeleteProduct($id)
    {
        $check = MainProduct::where('product_id',$id)->first();
        if ($check) {
            return Back()->with('error','You Can not delete this Product. It is used in product!');
        } else {
            Product::where('id', $id)->delete();

            return back()->with('error','Product Deleted Successfully!');
        }
        
    }
    public function DeleteCategory($id)
    {
        $check = Product::where('category_id',$id)->first();
        if ($check) {
            return Back()->with('error','You Can not delete this Category. It is used in product!');
        } else {
            Category::where('id', $id)->delete();

            return back()->with('error','Category Deleted Successfully!');
        }
    }
    public function DeleteDeliveryCompany($id)
    {
            DeliveryCompany::where('id', $id)->delete();

            return back()->with('error','Delivery Company Deleted Successfully!');
    }
    public function DeleteSupplier($id)
    {
        $check = Product::where('supplier_id',$id)->first();
        if ($check) {
            return Back()->with('error','You Can not delete this Supplier. It is used in product!');
        } else {
            SupplierDetail::where('id', $id)->delete();

            return back()->with('error','Supplier Deleted Successfully!');
        }
        
    }

    public function orders()
    {
        $data = Order::all();

        return view('front.order-list',compact('data'));
    }
}
