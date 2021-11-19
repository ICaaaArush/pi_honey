<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DeliveryCompany;
use App\Models\Category;
use App\Models\Branch;
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
        $branches = Branch::get();

        //  VIEW ADD PRODUCTS PAGE
        return view('front.supplyHandler.add-product', compact('listings','categories','suppliers','branches'));
    }

    public function InsertProduct(Request $request)
    {   $ran = rand(1000, 9999);

        $sup = SupplierDetail::where('id',$request->supplier)->first();

        $date = Carbon::now()->format('ymd');

        //  INSERT DELIVERY COMPANY
        $product = new Product;
        $product->id = $ran;
        $product->name = $request->input('name');
        $product->branch_id = $request->input('branch_id');
        $product->quantity = $request->input('quantity');
        $product->supplier_id = $request->input('supplier');
        $product->costing = $request->input('costing');
        $product->category_id = $request->input('category_id');
        // $product->sub_category_id = $request->input('sub_category_id');


        $product->save();

        if (strlen($product->quantity) == 2) {
            $qu = '00'.$product->quantity;
        } elseif(strlen($product->quantity) == 3) {
            $qu = '0'.$product->quantity;
        } elseif(strlen($product->quantity) == 1) {
            $qu = '000'.$product->quantity;
        } else{
            $qu = $product->quantity;
        }
        

        $barcode = $sup->id.$qu.$date;

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

    public function EditSupplier($id)
    {
        $supplier = SupplierDetail::where('id',$id)->first();
        return view('front.supplyHandler.edit-supplier', compact('supplier'));
    }

    public function InsertSupplier(Request $request)
    {   $ran = rand(1000, 9999);
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

    public function UpdateSupplier(Request $request)
    {   
        $update = SupplierDetail::where('id',$request->id)->update([
            'email' => $request->email,
            'alt_supplier_tell' => $request->alt_supplier_tell,
            'supplier_name' => $request->supplier_name,
            'supplier_tell' => $request->supplier_tell,
            'address' => $request->address,
        ]);

        return redirect(route('sh-supplier-list'))->with('success', 'Supplier Updated Successfully!');
    }

    public function SupplierList()
    {
        $listings = SupplierDetail::get();

        //  VIEW SUPPLIER LIST
        return view('front.supplyHandler.supplier-list', compact('listings'));
    }
}
