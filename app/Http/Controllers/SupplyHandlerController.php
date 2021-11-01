<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DeliveryCompany;
use App\Models\Category;
use App\Models\SupplierDetail;

class SupplyHandlerController extends Controller
{
    public function ProductList()
    {
        $listings = Product::paginate(25);

        //  VIEW PRODUCTS
        return view('supplyHandler.product-list',compact('listings'));
    }

    public function AddProduct()
    {
        $suppliers = SupplierDetail::get();
        $listings = Product::paginate(25);
        $categories = Category::get();

        //  VIEW ADD PRODUCTS PAGE
        return view('supplyHandler.add-product', compact('listings','categories','suppliers'));
    }

    public function InsertProduct(Request $request)
    {
        //  INSERT DELIVERY COMPANY
        $product = new Product;

        $product->name = $request->input('name');
        $product->quantity = $request->input('quantity');
        $product->supplier_id = $request->input('supplier');
        $product->costing = $request->input('costing');
        $product->price = $request->input('price');
        $product->profit = $request->input('profit');
        $product->category_id = $request->input('category_id');
        // $product->sub_category_id = $request->input('sub_category_id');
        $product->bar_code_sh = $request->input('qr_code');


        $product->save();

        return back()->with('message', 'Product Uploaded Successfully!');
    }

    public function AddSupplier()
    {
        $suppliers = SupplierDetail::get();
        return view('supplyHandler.add-supplier', compact('suppliers'));
    }

    public function InsertSupplier(Request $request)
    {
        //  INSERT DELIVERY COMPANY
        $suppiler = new SupplierDetail;

        $suppiler->supplier_name = $request->input('supplier_name');
        $suppiler->supplier_tell = $request->input('supplier_tell');
        $suppiler->address = $request->input('address');


        $suppiler->save();

        return back()->with('message', 'Product Uploaded Successfully!');
    }

    public function SupplierList()
    {
        $listings = SupplierDetail::get();

        //  VIEW SUPPLIER LIST
        return view('supplyHandler.supplier-list', compact('listings'));
    }
}
