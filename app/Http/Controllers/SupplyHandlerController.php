<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DeliveryCompany;
use App\Models\Category;

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
        $listings = Product::paginate(25);
        $categories = Category::get();

        //  VIEW ADD PRODUCTS PAGE
        return view('supplyHandler.add-product', compact('listings','categories'));
    }

    public function InsertProduct(Request $request)
    {
        //  INSERT DELIVERY COMPANY
        $product = new Product;

        $product->name = $request->input('name');
        $product->quantity = $request->input('quantity');
        $product->supplier_name = $request->input('supplier_name');
        $product->supplier_tell = $request->input('supplier_tell');
        $product->costing = $request->input('costing');
        $product->price = $request->input('price');
        $product->profit = $request->input('profit');
        $product->category_id = $request->input('category_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->qr_code = $request->input('qr_code');


        $product->save();

        return back()->with('message', 'Product Uploaded Successfully!');
    }
}
