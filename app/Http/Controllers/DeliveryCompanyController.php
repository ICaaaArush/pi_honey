<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryCompany;
use App\Models\Category;


class DeliveryCompanyController extends Controller
{
    
    public function DeliveryCompanies()
    {
        //  FETCH AND SHOW COMPANY LIST
        $listings = DeliveryCompany::paginate(25);

        return view('front.supmin.del-listing',compact('listings'));
    }

    public function AddDeliveryCompanies()
    {
        //  DELIVERY COMPANY ADDING PAGE
        return view('front.supmin.add-del-listing');
    }

    public function InsertDelComList(Request $request)
    {
        //  INSERT DELIVERY COMPANY
        $company = new DeliveryCompany;

        $company->company_name = $request->input('company_name');
        $company->address = $request->input('address');
        $company->phone_number = $request->input('phone_number');
        $company->delivery_charge = $request->input('delivery_charge');

        $company->save();

        return back()->with('message', 'Product Uploaded Successfully!');
    }

    public function CategoryList()
    {
        //  FETCH AND SHOW COMPANY LIST
        $listings = Category::paginate(25);

        return view('front.supmin.category-listing',compact('listings'));
    }

    public function AddCategory()
    {
        //  CATEGORY ADDING PAGE
        $listings = Category::paginate(25);

        return view('front.supmin.add-category',compact('listings'));
    }

    public function InsertCategory(Request $request)
    {
        //  INSERT DELIVERY COMPANY
        $category = new Category;

        $category->category_name = $request->input('category_name');

        $category->save();

        return back()->with('message', 'Product Uploaded Successfully!');
    }
}
