<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\DeliveryCompany;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Size;
use App\Models\Color;
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

    public function DeleteSubCategory($id)
    {
        $check = MainProduct::where('sub_category_id',$id)->first();
        if ($check) {
            return Back()->with('error','You Can not delete this SubCategory. It is used in product!');
        } else {
            SubCategory::where('id', $id)->delete();

            return back()->with('error','SubCategory Deleted Successfully!');
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

    public function customers()
    {
        $data = User::where('role','user')->get();

        return view('front.customer-list',compact('data'));
    }

    public function get_product_detail($id)
    {
        $data = MainProduct::where('m_barcode',$id)->first();
        $data['color'] = Color::where('id',$data->color_id)->first();

        $product = Product::where('id',$data->product_id)->first();

        $data['category'] = Category::where('id',$product->category_id)->first();
        $data['supplier'] = SupplierDetail::where('id',$product->supplier_id)->first();
        $data['size'] = Size::where('id',$data->size_id)->first();

        return $data;
    }

    public function get_products_detail($id)
    {
        $data = Product::where('bar_code_sh',$id)->first();

        $data['category'] = Category::where('id',$data->category_id)->first();
        $data['supplier'] = SupplierDetail::where('id',$data->supplier_id)->first();

        return $data;
    }
}
