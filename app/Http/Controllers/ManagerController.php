<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MainProduct;
use App\Models\DeliveryCompany;
use App\Models\Category;

class ManagerController extends Controller
{
    //  VIEW PRODUCTS
    public function ProductList()
    {
        $listings = Product::paginate(25);
  
        return view('front.manager.product-list', compact('listings'));
    }

    //  VIEW ADD PRODUCT PAGE WITH CATEGORIES
    public function AddProduct()
    {
        $categories = Category::get();
        $listings = Product::paginate(25);
        $suppliers = SupplierDetail::get();

        
        return view('front.manager.add-product', compact('listings','categories','suppliers'));
    }

    //  INSERT DELIVERY COMPANY
    public function InsertProduct(Request $request)
    {
        
        $product = new Product;

        $product->name = $request->input('name');
        $product->quantity = $request->input('quantity');
        $product->supplier_name = $request->input('supplier_name');
        $product->supplier_tell = $request->input('supplier_tell');
        // $product->costing = $request->input('costing');
        $product->price = $request->input('price');
        $product->profit = $request->input('profit');
        $product->category_id = $request->input('category_id');
        // $product->sub_category_id = $request->input('sub_category_id');
        $product->qr_code = $request->input('qr_code');


        $product->save();

        return back()->with('message', 'Product Uploaded Successfully!');
    }

    //  ADD PRICE TO PRODUCT
    public function InsertPrice(Request $request)
    {
        $product = Product::find($request->productId);

        $product->price = $request->price;

        $product->save();

        return back()->with('message', 'Product Uploaded Successfully!');
    }

    // VIEW SORTED PRODUCTS
    public function SortedProductList()
    {
        $listings = MainProduct::paginate(25);
        dd($listings);

        // VIEW SORTED PRODUCTS
        return view('front.manager.sorted-main-product-list', compact('listings'));
    }

    public function ChangeSortStatus(Request $request)
    {
        // dd($request->all());
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
  
        return response()->json(['success'=>'Status change successfully.']);
    }
}
