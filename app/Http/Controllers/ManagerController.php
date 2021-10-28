<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DeliveryCompany;
use App\Models\Category;

class ManagerController extends Controller
{
    public function ProductList()
    {
        $listings = Product::paginate(25);

        //  VIEW PRODUCTS
        return view('manager.product-list',compact('listings'));
    }

    public function AddProduct()
    {
        $listings = Product::paginate(25);

        return view('manager.add-product');
    }

}
