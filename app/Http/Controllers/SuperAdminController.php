<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryCompany;
use App\Models\MainProduct;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Quality;

class SuperAdminController extends Controller
{
    //  LIST DELIVERY COMPANIES
    public function DeliveryCompanies()
    {
        $dcoms = DeliveryCompany::paginate(10);
        return view('front.supmin.delivery-companies', compact($dcoms));
    }

    public function color_list()
    {
        $data = Color::all();

        return view('front.supmin.color-listing',compact('data'));
    }

    public function add_color()
    {
        return view('front.supmin.add-color');
    }

    public function store_color(Request $request)
    {
        $add = new Color;

        $add->color = $request->color;

        $add->save();

        return redirect(route('color-list'))->with('success','Color Added Successfully!');
    }

    public function delete_color($id)
    {
        $check = MainProduct::where('color_id',$id)->first();
        if ($check) {
            return back()->with('error','You Can Not Delete This Color. This Has Been Used In Products!');
        } else {
            $delete = Color::where('id',$id)->delete();

            return back()->with('error','Color Deleted Successfully!');
        }
    }

    public function brand_list()
    {
        $data = Brand::all();

        return view('front.supmin.brand-listing',compact('data'));
    }

    public function add_brand()
    {
        return view('front.supmin.add-brand');
    }

    public function store_brand(Request $request)
    {
        $add = new Brand;

        $add->brand = $request->brand;

        $add->save();

        return redirect(route('brand-list'))->with('success','Brand Added Successfully!');
    }

    public function delete_brand($id)
    {
        $check = MainProduct::where('brand_id',$id)->first();
        if ($check) {
            return back()->with('error','You Can Not Delete This Brand. This Has Been Used In Products!');
        } else {
            $delete = Brand::where('id',$id)->delete();

            return back()->with('error','Brand Deleted Successfully!');
        }
    }

    public function size_list()
    {
        $data = Size::all();

        return view('front.supmin.size-listing',compact('data'));
    }

    public function add_size()
    {
        return view('front.supmin.add-size');
    }

    public function store_size(Request $request)
    {
        $add = new Size;

        $add->size = $request->size;

        $add->save();

        return redirect(route('size-list'))->with('success','Size Added Successfully!');
    }

    public function delete_size($id)
    {
        $check = MainProduct::where('size_id',$id)->first();
        if ($check) {
            return back()->with('error','You Can Not Delete This Size. This Has Been Used In Products!');
        } else {
            $delete = Size::where('id',$id)->delete();

            return back()->with('error','Size Deleted Successfully!');
        }
    }

    public function quality_list()
    {
        $data = Quality::all();

        return view('front.supmin.quality-listing',compact('data'));
    }

    public function add_quality()
    {
        return view('front.supmin.add-quality');
    }

    public function store_quality(Request $request)
    {
        $add = new Quality;

        $add->quality = $request->quality;

        $add->save();

        return redirect(route('quality-list'))->with('success','Quality Added Successfully!');
    }

    public function delete_quality($id)
    {
        $check = MainProduct::where('quality_id',$id)->first();
        if ($check) {
            return back()->with('error','You Can Not Delete This Quality. This Has Been Used In Products!');
        } else {
            $delete = Quality::where('id',$id)->delete();

            return back()->with('error','Quality Deleted Successfully!');
        }
    }

    public function branch_list()
    {
        $data = Branch::all();

        return view('front.supmin.branch-listing',compact('data'));
    }

    public function add_branch()
    {
        return view('front.supmin.add-branch');
    }

    public function store_branch(Request $request)
    {
        $add = new Branch;

        $add->branch = $request->branch;

        $add->save();

        return redirect(route('branch-list'))->with('success','Branch Added Successfully!');
    }

    public function delete_branch($id)
    {
        $check = Product::where('branch_id',$id)->first();
        if ($check) {
            return back()->with('error','You Can Not Delete This Branch. This Has Been Used In Products!');
        } else {
            $delete = Branch::where('id',$id)->delete();

            return back()->with('error','Branch Deleted Successfully!');
        }
    }
}
