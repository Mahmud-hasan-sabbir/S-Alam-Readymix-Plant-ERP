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

        return redirect()->route('rawinvoiceapprove_list')->with('success', 'Raw Invoice created successfully.');



    }

    public function rawinvoiceview(Request $request)
    {
        $rawinvoice = rawInvoice::with('rawInvoiceDetail')->where('id', $request->id)->first();
        $invoicedetails = rawInvoiceDetail::where('rawInvoice_id', $request->id)
        ->join('categories', 'raw_invoice_details.category_id', '=', 'categories.id')
        ->join('materials', 'raw_invoice_details.material_id', '=', 'materials.id')
        ->join('store_names', 'raw_invoice_details.store_id', '=', 'store_names.id')
        ->join('units', 'raw_invoice_details.unit_id', '=', 'units.id')
        ->select(
            'raw_invoice_details.*',
            'categories.name as category_name',
            'materials.name as material_name',
            'store_names.name as store_name',
            'units.name as unit_name'
        )
        ->get();



        return response()->json([
            'rawinvoice' => $rawinvoice,
            'invoicedetails' => $invoicedetails
        ]);

    }

    public function rawinvoicedelete(Request $request)
    {
        $rawinvoice = rawInvoice::with('rawInvoiceDetail')->where('id', $request->id)->first();
        $rawinvoice->delete();
        return response()->json(['success' => 'Raw invoice has been deleted']);
    }

    public function rawinvoiceapproveList()
    {
        $approveList = rawInvoice::with('rawInvoiceDetail','customer')->where('is_approve', 0)->orderBy('id', 'desc')->get();
        return view('layouts.pages.rawinvoice.rawinvoiceapprovelist', compact('approveList'));
    }

    public function rawinvoiceapprove($id)
    {
        // ইনভয়েস তথ্য চেক করা
        $rawinvoice = rawInvoice::where('id', $id)->first();
        if (!$rawinvoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        $rawinvoice->is_approve = 1;
        $rawinvoice->save();

        $rawinvoiceDetails = rawInvoiceDetail::where('rawInvoice_id', $id)->get();

        foreach ($rawinvoiceDetails as $detail) {

            $stock = stockValue::where('material_id', $detail->material_id)->first();

            if ($stock) {
                $stock->decrement('cur_qty', $detail->Qty); // cur_qty কমাবে
                $stock->increment('sale_qty', $detail->Qty); // sale_qty বাড়াবে

            }
        }

        return response()->json(['success' => true, 'message' => 'Raw invoice has been approved and stock updated']);
    }










}
