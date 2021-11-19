<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DeliveryCompany;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ReturnProduct;
use App\Models\Color;
use App\Models\User;
use App\Models\Size;
use App\Models\MainProduct;
use App\Models\RejectedProduct;
use App\Models\SupplierDetail;
use Illuminate\Support\Facades\Storage;
use Hash;


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
        // $delete = MainProduct::where('product_id',$request->id)->delete();
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
                if($prod['quantity'] != null){

                    if(isset($prod['pic']))
                    {
                        if ($prod['pic'] != null) {
                            $originalpath = $prod['pic']->store('public/product_pic');
                    
                            $path = str_replace('public','storage',$originalpath );
                        }

                    };


                    $id = rand('1000000','9999999');

                    $add = new MainProduct;
                    $add->id = $id;
                    $add->product_id = $request->id;
                    $add->sub_category_id = $prod['sub_category_id'];
                    $add->branch_id = $request->branch_id;
                    $add->name = $prod['description'];
                    $add->quantity = $prod['quantity'];
                    $add->brand_id = $prod['brand'];
                    $add->color_id = $prod['color'];
                    $add->size_id = $prod['size'];
                    $add->quality_id = 0;
                    $add->cost = $cost;
                    if(isset($prod['pic']) )
                    {
                    if ($prod['pic'] != null) {
                    $add->pic = $path;
                    }
                    };
                    $add->save();
                }
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

            return redirect(route('de-product-list'))->with('success','Product Sorted Successfully!');
        }else{
            foreach($request->product as $prod){
                if($prod['quantity'] != null){

                    $id = rand('1000000','9999999');

                    if(isset($prod['pic']) )
                    {
                    if ($prod['pic'] != null) {
                    $originalpath = $prod['pic']->store('public/product_pic');
            
                    $path = str_replace('public','storage',$originalpath );
                    }
                    };

                    $add = new MainProduct;
                    $add->id = $id;
                    $add->product_id = $request->id;
                    $add->sub_category_id = $prod['sub_category_id'];
                    $add->branch_id = $request->branch_id;
                    $add->name = $prod['description'];
                    $add->quantity = $prod['quantity'];
                    $add->brand_id = $prod['brand'];
                    $add->color_id = $prod['color'];
                    $add->size_id = $prod['size'];
                    $add->quality_id = 0;
                    $add->cost = $cost;
                    if(isset($prod['pic']) )
                    {
                    if ($prod['pic'] != null) {
                    $add->pic = $path;
                    }
                    }
                    $add->save();
                }
            }

            if($request->reject_reason != null & $request->rejectquantity != null)
            {
                $reason = new RejectedProduct;
                $reason->product_id = $request->id;
                $reason->reason = $reason->reject_reason;
                $reason->quantity = $request->rejectquantity;
                $reason->save();
            }

            return redirect(route('de-product-list'))->with('success','Product Partially Sorted Successfully!');
        };

        //  INSERT DELIVERY COMPANY
        // $product = new MainProduct;

        // $product->product_id = $request->id;
        
        

        return back()->with('message', 'Product Uploaded Successfully!');
    }

    public function ProductSort($id)
    { 
        $product = Product::find($id);

        $brand = Brand::all();
        $size = Size::all();
        $color = Color::all();
        $sub_category = SubCategory::where('category_id',$product->category_id)->get();
        $sorts = MainProduct::where('product_id',$id)->get();

        //  VIEW UNSORTED PRODUCT
        return view('front.deh.sort-product', compact('product','brand','color','size','sorts','sub_category'));
    }

    public function add_order()
    {
        $delivery = DeliveryCompany::all();
        return view('front.deh.add-product',compact('delivery'));
    }

    public function add_product($id)
    {
        $data = MainProduct::where('m_barcode',$id)->first();

        $data['color'] = Color::where('id',$data->color_id)->first();

        $data['size'] = Size::where('id',$data->size_id)->first();

        $data['brand'] = Brand::where('id',$data->brand_id)->first();

        return $data;
    }

    public function add($id)
    {
        $get = MainProduct::where('m_barcode',$id)->first();

        $data['data'] = $get;

        $data['color'] = Color::where('id',$get->color_id)->first();

        $data['size'] = Size::where('id',$get->size_id)->first();

        $data['brand'] = Brand::where('id',$get->brand_id)->first();

        return $data;
    }

    public function store_order(Request $request)
    { 
        $check = User::where('phone',$request->customer_phone)->first();

        if ($check) {
            $customer_id = $check->id;
        } else {
            $rand = rand('1','1000');
            $create = new User;
            $create->name = $request->customer_name;
            if ($request->customer_email == null) {
                $create->email = 'email'.$rand.'@mail.com';
            } else {
                $create->email = $request->customer_email;
            }
            $create->dob = $request->customer_dob;
            $create->password = Hash::make($rand);
            $create->role = 'user';
            $create->phone = $request->customer_phone;
            $create->save();

            $customer_id = $create->id;
        }

        $order = new Order;
        $order->user_id = $customer_id;
        $order->delivery_company_id = $request->delivery_id;
        $order->delivery_profit = $request->delivery_profit;
        $order->delivery_charge = $request->delivery_charge;
        $order->precessing_fee = $request->processing_fee;
        $order->precessing_percentage = $request->processing_percentage;
        $order->total = $request->total;
        $order->save();


        foreach($request->product as $item)
        {
            $orderdetail = new OrderDetail;
            $orderdetail->order_id = $order->id;
            $orderdetail->main_product_id = $item['id'];
            $orderdetail->quantity = $item['quantity'];
            $orderdetail->save();

            $data = MainProduct::where('id',$item['id'])->first();

            $minus = MainProduct::where('id',$item['id'])->update([
                'quantity' => $data->quantity - $item['quantity']
            ]);
        }

        return back()->with('success','Order Placed Successfully!');

        
    }

    public function add_return_product()
    {
        return view('front.deh.add-return-product');
    }

    public function store_return_product(Request $request)
    {
        $check = MainProduct::where('m_barcode', $request->main_product_barcode)->first();

        if ($check) {
            $add =  new ReturnProduct;
            $add->main_product_barcode = $request->main_product_barcode;
            $add->order_id = $request->order_id;
            $add->user_phone = $request->user_phone;
            $add->quantity = $request->quantity;
            $add->save();

            return back()->with('success','Return Product Notice Added Successfully!');
        } else {
            return back()->with('error','Product Not Found!');
        }
        
    }
}
