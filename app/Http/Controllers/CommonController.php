<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
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
        Product::where('id', $id)->delete();

        return redirect()->back();
    }
    public function DeleteCategory($id)
    {
        Category::where('id', $id)->delete();

        return redirect()->back();
    }
    public function DeleteDeliveryCompany($id)
    {
        DeliveryCompany::where('id', $id)->delete();

        return redirect()->back();
    }
    public function DeleteSupplier($id)
    {
        SupplierDetail::where('id', $id)->delete();

        return redirect()->back();
    }
}
