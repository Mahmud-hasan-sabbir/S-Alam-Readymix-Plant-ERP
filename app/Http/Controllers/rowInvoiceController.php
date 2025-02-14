<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\rawInvoice;
use App\Models\SallerInformation;
use App\Models\datasetting\storeName;
use App\Models\datasetting\unit;
use App\Models\datasetting\category;

class rowInvoiceController extends Controller
{
    public function rawInvoice()
    {
        $allcategory = category::all();
        $allunit = unit::all();
        $allstoreName = storeName::all();
        $allCustomer = SallerInformation::where('category',2)->where('Status','Active')->get();
        $rawsale_codes = Helper::IDGenerator(new rawInvoice, 'RI_No', 5, 'RI-NO');
       
        return view('layouts.pages.rawinvoice.rawinvoice', compact('rawsale_codes','allCustomer','allstoreName','allunit','allcategory'));
    }

   
}
