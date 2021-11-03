<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DeliveryCompany;
use App\Models\Category;
use App\Models\MainProduct;
use App\Models\RejectedProduct;
use App\Models\SupplierDetail;


class DataEntryHandler extends Controller
{
    public function ProductList()
    {
        $listings = Product::paginate(25);

        //  VIEW PRODUCTS
        return view('front.deh.product-list',compact('listings'));
    }

    public function AddProduct()
    {
        $listings = Product::paginate(25);
        $categories = Category::get();
        $suppliers = SupplierDetail::get();

        //  VIEW ADD PRODUCTS PAGE
        return view('front.deh.add-product', compact('listings','categories','suppliers'));
    }

    public function InsertProduct(Request $request)
    {
        $quantity = 0;
        $cost = $request->cost / $request->quantity; 
        foreach($request->product as $prod)
        {
            $quantity += $prod['quantity'];
        }

        $quantity += $request->rejectquantity;

        if($quantity == $request->quantity)
        {
            foreach($request->product as $prod){
                $add = new MainProduct;
                $add->product_id = $request->id;
                $add->name = $prod['name'];
                $add->quantity = $prod['quantity'];
                $add->cost = $cost;
                $add->de_barcode = $prod['barcode'];
                $add->save();
            }

            if($request->reject_reason != null & $request->rejectquantity != null)
            {
                $reason = new RejectedProduct;
                $reason->product_id = $request->id;
                $reason->reason = $reason->reject_reason;
                $reason->quantity = $request->rejectquantity;
                $reason->save();
            }

            $status = Product::where('id',$request->id)->update([
                'status' => 1
            ]);

            return redirect(route('de-product-list'));
        }else{
            return back()->with('error','Product Quantity Doesn"t Match!');
        };

        //  INSERT DELIVERY COMPANY
        // $product = new MainProduct;

        // $product->product_id = $request->id;
        
        

        return back()->with('message', 'Product Uploaded Successfully!');
    }

    public function ProductSort($id)
    {
        $product = Product::find($id);

        //  VIEW UNSORTED PRODUCT
        return view('front.deh.sort-product', compact('product'));
    }
}
