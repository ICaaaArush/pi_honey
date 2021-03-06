<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MainProduct;
use App\Models\DeliveryCompany;
use App\Models\Category;
use App\Models\Quality;
use App\Models\SupplierDetail;
use App\Models\ReturnProduct;
use App\Models\OrderDetail;
use App\Models\Order;
use Carbon\Carbon;

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
        $productss = MainProduct::find($request->productId);

        $sup = Product::where('id',$productss->product_id)->first();

        $date = Carbon::now()->format('mY');       
        
        $barcode =  $sup->supplier_id.$date.$request->productId;

        $product = MainProduct::find($request->productId);

        $product->price = $request->input('price');
        $product->quality_id = $request->input('quality');
        $product->m_barcode = $barcode;

        $product->save();

        return redirect('/manager/ma-sorted-product-list')->with('success', 'Product Uploaded Successfully!');
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
        $qualities = Quality::get();
        $listings = MainProduct::find($id);

        
        return view('front.manager.edit-product', compact('listings','categories','suppliers','qualities'));
    }

    public function ReturnProductList()
    {
        $data = ReturnProduct::latest()->get();

        return view('front.manager.return-product-list',compact('data'));
    }

    public function confirm_return(Request $request)
    {
        $data = ReturnProduct::where('id',$request->id)->first();

        $preproduct = MainProduct::where('m_barcode', $data->main_product_barcode)->first();

        $product = MainProduct::where('m_barcode', $data->main_product_barcode)->update([
            'quantity' => $preproduct->quantity + $data->quantity
        ]);

        $update = ReturnProduct::where('id',$request->id)->update([
            'status' => 1,
            'note' => $request->note
        ]);

        $orderdetail = OrderDetail::where('order_id',$data->order_id)->where('main_product_id', $preproduct->id)->first();

        $update_order = OrderDetail::where('order_id',$data->order_id)->where('main_product_id', $preproduct->id)->update([
            'quantity' => $orderdetail->quantity - $data->quantity
        ]);

        return back()->with('success','Return Product Confirmed Successfully!');
    }
}
