<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\rawInvoice;
use App\Models\rawInvoiceDetail;
use App\Models\SallerInformation;
use App\Models\datasetting\storeName;
use App\Models\datasetting\unit;
use App\Models\datasetting\category;
use App\Models\stockValue;
use App\Models\datasetting\materials;

class rowInvoiceController extends Controller
{
    public function rawInvoice()
    {
        $allrawinvoice = rawInvoice::with('rawInvoiceDetail','customer')->orderBy('id', 'desc')->get();
        $allcategory = category::all();
        $allunit = unit::all();
        $allstoreName = storeName::all();
        $allCustomer = SallerInformation::where('category',2)->where('Status','Active')->get();
        $rawsale_codes = Helper::IDGenerator(new rawInvoice, 'RI_No', 5, 'RI-NO');



        return view('layouts.pages.rawinvoice.rawinvoice', compact('rawsale_codes','allCustomer','allstoreName','allunit','allcategory','allrawinvoice'));
    }

    public function getMaterials(Request $request)
    {
       $allmaterials = materials::where('category_id',$request->id)->get();
       return response()->json($allmaterials);
    }

    public function getStockValue(Request $request)
    {
        $stock = stockValue::where('material_id', $request->material_id)->first();
        return response()->json(['stock_value' => $stock ? $stock->cur_qty : null]);
    }

    public function storeRawinvoice(Request $request)
    {


        $rawinvoice = new rawInvoice();
        $rawinvoice->RI_No = $request->RI_No;
        $rawinvoice->order_date = $request->inv_date;
        $rawinvoice->customer_id = $request->customer_name;
        $rawinvoice->Total_sale_amount = $request->netamount;
        $rawinvoice->discount = $request->discount;
        $rawinvoice->status = 0;
        $rawinvoice->is_approve = 0;
        $rawinvoice->remarks = $request->remarks;
        $rawinvoice->user_id = auth()->user()->id;
        $rawinvoice->save();



        // Loop through product_id array and insert details
        foreach ($request->product_id as $key => $value) {
            $rawinvoiceDetail = new rawInvoiceDetail();
            $rawinvoiceDetail->rawInvoice_id = $rawinvoice->id;
            $rawinvoiceDetail->material_id = $value;
            $rawinvoiceDetail->category_id = $request->category_id[$key];
            $rawinvoiceDetail->store_id = $request->store_id[$key];
            $rawinvoiceDetail->unit_id = $request->unit_id[$key];
            $rawinvoiceDetail->location = $request->location[$key];
            $rawinvoiceDetail->Qty = $request->quantity[$key];
            $rawinvoiceDetail->unit_price = $request->unit_price[$key];
            $rawinvoiceDetail->sub_total = $request->sub_total[$key];
            $rawinvoiceDetail->save();
        }

        return redirect()->back()->with('success', 'Raw Invoice created successfully.');





        // $stock = stockValue::where('material_id', $request->material_id)->first();
        // if ($stock) {
        //     $stock->cur_qty = $stock->cur_qty - $request->qty;
        //     $stock->save();
        // }

        return redirect()->route('rawinvoice')->with('success', 'Raw Invoice created successfully.');

    }




}
