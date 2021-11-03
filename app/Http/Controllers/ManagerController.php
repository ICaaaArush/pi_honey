<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MainProduct;
use App\Models\DeliveryCompany;
use App\Models\Category;
use App\Models\SupplierDetail;

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
        $product = MainProduct::find($request->productId);

        $product->price = $request->input('price');
        $product->m_barcode = $request->input('m_barcode');

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
        $listings = MainProduct::get();

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

    //  VIEW ADD PRODUCT PAGE WITH CATEGORIES
    public function MaEdit($id)
    {
        $categories = Category::get();
        $suppliers = SupplierDetail::get();
        $listings = MainProduct::find($id);

        
        return view('front.manager.edit-product', compact('listings','categories','suppliers'));
    }
}
