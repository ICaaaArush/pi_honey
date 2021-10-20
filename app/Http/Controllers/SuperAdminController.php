<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryCompany;


class SuperAdminController extends Controller
{
    //  LIST DELIVERY COMPANIES
    public function DeliveryCompanies()
    {
        $dcoms = DeliveryCompany::paginate(10);
        return view('supmin.delivery-companies', compact($dcoms));
    }
}
