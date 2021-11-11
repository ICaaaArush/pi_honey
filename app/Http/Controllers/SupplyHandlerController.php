<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DeliveryCompany;
use App\Models\Category;
use App\Models\SupplierDetail;
use Carbon\Carbon;;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SupplyHandlerController extends Controller
{
    public function ProductList()
    {
        $listings = Product::get();

        // $listings = Product::find(1)->categoryShakaLaka()->first();

        //  VIEW PRODUCTS
        return view('front.supplyHandler.product-list',compact('listings'));
    }

    public function AddProduct()
    {
        $suppliers = SupplierDetail::get();
        $listings = Product::paginate(25);
        $categories = Category::get();

        //  VIEW ADD PRODUCTS PAGE
        return view('front.supplyHandler.add-product', compact('listings','categories','suppliers'));
    }

    public function InsertProduct(Request $request)
    {   $ran = rand(1000, 9999);

        $sup = SupplierDetail::where('id',$request->supplier)->first();

        $date = Carbon::now()->format('dm');

        //  INSERT DELIVERY COMPANY
        $product = new Product;
        $product->id = $ran;
        $product->name = $request->input('name');
        $product->quantity = $request->input('quantity');
        $product->supplier_id = $request->input('supplier');
        $product->costing = $request->input('costing');
        $product->price = $request->input('price');
        $product->profit = $request->input('profit');
        $product->category_id = $request->input('category_id');
        // $product->sub_category_id = $request->input('sub_category_id');


        $product->save();

        $barcode = $sup->id.$product->id.$date;

        $bar_add = Product::where('id',$product->id)->update([
            'bar_code_sh' => $barcode
        ]);

        return back()->with('success', 'Product Uploaded Successfully!');
    }

    public function AddSupplier()
    {
        $suppliers = SupplierDetail::get();
        return view('front.supplyHandler.add-supplier', compact('suppliers'));
    }

    public function InsertSupplier(Request $request)
    {   $ran = rand(100, 999);
        //  INSERT DELIVERY COMPANY
        $suppiler = new SupplierDetail;
        $suppiler->id = $ran;
        $suppiler->email = $request->input('email');
        $suppiler->alt_supplier_tell = $request->input('alt_supplier_tell');
        $suppiler->supplier_name = $request->input('supplier_name');
        $suppiler->supplier_tell = $request->input('supplier_tell');
        $suppiler->address = $request->input('address');


        $suppiler->save();

        return redirect(route('sh-supplier-list'))->with('success', 'Supplier Uploaded Successfully!');
    }

    public function SupplierList()
    {
        $listings = SupplierDetail::get();

        //  VIEW SUPPLIER LIST
        return view('front.supplyHandler.supplier-list', compact('listings'));
    }
}
