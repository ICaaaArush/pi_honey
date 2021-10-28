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
}
