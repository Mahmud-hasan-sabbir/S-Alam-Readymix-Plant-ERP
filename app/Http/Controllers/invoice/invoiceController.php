<?php

namespace App\Http\Controllers\invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SallerInformation;
use App\Models\datasetting\grade;
use App\Helpers\Helper;
use App\Models\invoice\invoice;
use App\Models\invoiceDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\purchase\PurchaseDetails;
use App\Models\stockValue;
use App\Models\consumption;

use Illuminate\Support\Facades\DB;


class invoiceController extends Controller
{
    public function addInvoice()
    {
        $customer = SallerInformation::where('category',2)->where('Status','Active')->get();
        $allgrade = grade::all();
        $inv_codes = Helper::IDGenerator(new invoice, 'inv_no', 5, 'INV-NO');
        $allinvoice = invoice::with('customerName')->latest()->get();
        return view('layouts.pages.invoice.add_invoice',compact('customer','allgrade','inv_codes','allinvoice'));
    }


    public function storeInvoice(Request $request)
    {

        // Save the main invoice
        $invoice = new Invoice();
        $invoice->inv_no = $request->inv_no;
        $invoice->date = $request->inv_date;
        $invoice->cus_id = $request->customer_id;

        $invoice->total_amount = $request->total_amount_hidden;
        $invoice->status = 0;
        $invoice->description = $request->remarks;
        $invoice->user_id = Auth::user()->id;
        $invoice->save();

        // Save invoice details
        foreach ($request->grade_id as $key => $grade_id) {
            $invoiceDetail = new InvoiceDetail();
            $invoiceDetail->inv_id = $invoice->id;
            $invoiceDetail->grade_id = $request->grade_id[$key];
            $invoiceDetail->location = $request->location[$key];
            $invoiceDetail->qty_m3 = $request->qty_m3[$key];
            $invoiceDetail->qty_cft = $request->qty_cft[$key];
            $invoiceDetail->unit_price_cft = $request->unit_price_cft[$key];
            $invoiceDetail->service_search = $request->service_price_cft[$key];
            $invoiceDetail->sub_total = $request->sub_total[$key];
            $invoiceDetail->save();
        }

        // Set up notification
        $notification = ['messege' => 'Invoice saved successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }


    public function invoiceEdit($id)
    {
        $customer = SallerInformation::where('category',2)->where('Status','Active')->get();
        $findinvoice = invoice::with('invdetail.grade')->where('id',$id)->first();
        $allgrade = grade::all();
        return view('layouts.pages.invoice.edit_invoice',compact('findinvoice','customer','allgrade'));
    }

    public function updateInvoice(Request $request, $id)
    {

        // Retrieve and update the main invoice
        $invoiceupdate = Invoice::where('id', $id)->first();
        $invoiceupdate->inv_no = $request->inv_no;
        $invoiceupdate->date = $request->inv_date;
        $invoiceupdate->cus_id = $request->customer_id;
        $invoiceupdate->description = $request->remarks;
        $invoiceupdate->total_amount = $request->total_amount_hidden;
        $invoiceupdate->status = 0;
        $invoiceupdate->user_id = Auth::user()->id;
        $invoiceupdate->save();

        // Update or create invoice details
        $existingIds = [];

        foreach ($request->grade_id as $key => $grade_id) {
            $invoiceDetailupdate = InvoiceDetail::updateOrCreate(
                [
                    'id' => $request->input('detail_id.' . $key) ?? null, // Assuming you have 'detail_id' in the request
                ],
                [
                    'inv_id' => $invoiceupdate->id,
                    'grade_id' => $grade_id,
                    'location' => $request->location[$key],
                    'qty_m3' => $request->qty_m3[$key],
                    'qty_cft' => $request->qty_cft[$key],
                    'unit_price_cft' => $request->unit_price_cft[$key],
                    'service_search' => $request->service_price_cft[$key],
                    'sub_total' => $request->sub_total[$key],
                ]
            );

            $existingIds[] = $invoiceDetailupdate->id;
        }

        // Delete any invoice details that were not included in the update
        InvoiceDetail::where('inv_id', $invoiceupdate->id)
            ->whereNotIn('id', $existingIds)
            ->delete();

        $notification = ['messege' => 'Invoice updated successfully', 'alert-type' => 'success'];
        return redirect()->route('add_invoice')->with($notification);
    }


    public function invoiceView(Request $request)
    {
        $findinvoice = invoice::with('invdetail.grade')->where('id',$request->id)->first();
        return response()->json($findinvoice);
    }

    public function invoiceApproveList()
    {
        $allinvoice = invoice::with('customerName')->where('status',0)->latest()->get();
        $customer = SallerInformation::where('category',2)->where('Status','Active')->get();
        return view('layouts.pages.invoice.approve_list',compact('allinvoice','customer'));
    }

    public function invoiceApprove($id)
    {
        invoice::where('id', $id)->update(['status' => 1]);
        $notification = ['messege' => 'Invoice Approve successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function invoiceCancaled($id)
    {

        Invoice::where('id', $id)->delete();
        invoiceDetail::where('inv_id', $id)->delete();
        $notification = ['messege' => 'Invoice and related items deleted successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }


    public function consumption()
    {
        $invoice = invoice::with('customerName')->where('status',1)->latest()->get();
        $consum = Consumption::all()->groupBy('invoice_id');
        return view('layouts.pages.consumption.consumption',compact('invoice','consum'));
    }
    public function consumAdd($id)
    {

        $invoice = invoice::with('customerName','invdetail')->where('id',$id)->first();

        $blackstone = stockValue::where('material_id',1)->first();
        $mixedbuilder = stockValue::where('material_id',2)->first();
        $dubai = stockValue::where('material_id',3)->first();
        $mm10 = stockValue::where('material_id',4)->first();
        $pccCement = stockValue::where('material_id',5)->first();
        $opcCement = stockValue::where('material_id',6)->first();
        $begCement = stockValue::where('material_id',7)->first();
        $sand = stockValue::where('material_id',8)->first();
        $admixer = stockValue::where('material_id',9)->first();
        $bricks = stockValue::where('material_id',10)->first();
        // dd($ddd);
        return view('layouts.pages.consumption.consum_add',compact('invoice','blackstone','mixedbuilder','dubai','mm10','pccCement','opcCement','begCement','sand','admixer','bricks'));
    }


    // public function storeConsumption(Request $request)
    // {
    //     // Access invoice_id
    //     $invoiceId = $request->invoice_id;

    //     // Process other form data
    //     foreach ($request->invoice_id as $key => $invoiceId) {
    //         $consumption = new Consumption();
    //         $consumption->date = $request->date[$key];
    //         $consumption->invoice_id = $invoiceId;
    //         $consumption->customer_id = $request->customer_id[$key];
    //         $consumption->grade_id = $request->grade_id[$key];
    //         $consumption->quantity = $request->quantity[$key];
    //         $consumption->black_stone = $request->black_stone[$key];
    //         $consumption->mixed_builder = $request->mixed_builder[$key];
    //         $consumption->dubai = $request->dubai[$key];
    //         $consumption->mm10 = $request->mm10[$key];
    //         $consumption->pcc_cement = $request->pcc_cement[$key];
    //         $consumption->opc_cement = $request->opc_cement[$key];
    //         $consumption->beg_cement = $request->beg_cement[$key];
    //         $consumption->sand = $request->sand[$key];
    //         $consumption->admixer = $request->admixer[$key];
    //         $consumption->bricks = $request->bricks[$key];
    //         $consumption->save();
    //     }

    //     $notification = ['message' => 'Consumption data saved successfully', 'alert-type' => 'success'];
    //     return redirect()->back()->with($notification);
    // }

    public function storeConsumption(Request $request)
    {
        // Check if quantity field is null
        if ($request->quantity == null) {
            $notification = [
                'message'    => 'You must fill in the Quantity field!',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }

        // Count the number of consumption entries
        $count = count($request->quantity);

        // Loop through each consumption entry and save to database
        for ($i = 0; $i < $count; $i++) {
            $consumption = new Consumption();
            $consumption->date = date('Y-m-d', strtotime($request->date[$i]));
            $consumption->invoice_id = $request->invoice_id[$i];
            $consumption->customer_id = $request->customer_id[$i];
            $consumption->grade_id = $request->grade_id[$i];
            $consumption->quantity = $request->quantity[$i];
            $consumption->black_stone = $request->black_stone[$i];
            $consumption->mixed_builder = $request->mixed_builder[$i];
            $consumption->dubai = $request->dubai[$i];
            $consumption->mm10 = $request->mm10[$i];
            $consumption->pcc_cement = $request->pcc_cement[$i];
            $consumption->opc_cement = $request->opc_cement[$i];
            $consumption->beg_cement = $request->beg_cement[$i];
            $consumption->sand = $request->sand[$i];
            $consumption->admixer = $request->admixer[$i];
            $consumption->bricks = $request->bricks[$i];
            $consumption->save();

            // Update product quantities
            $this->updateProductQuantity(1, $request->black_stone[$i]);
            $this->updateProductQuantity(2, $request->mixed_builder[$i]);
            $this->updateProductQuantity(3, $request->dubai[$i]);
            $this->updateProductQuantity(4, $request->mm10[$i]);
            $this->updateProductQuantity(5, $request->pcc_cement[$i]);
            $this->updateProductQuantity(6, $request->opc_cement[$i]);
            $this->updateProductQuantity(7, $request->beg_cement[$i]);
            $this->updateProductQuantity(8, $request->sand[$i]);
            $this->updateProductQuantity(9, $request->admixer[$i]);
            $this->updateProductQuantity(10, $request->bricks[$i]);
        }

        // Return success notification
        $notification = [
            'message'    => 'Consumption added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('consumption')->with($notification);
    }

    /**
     * Update the product quantity in the database.
     *
     * @param int $materialId
     * @param int $quantity
     * @return void
     */
    protected function updateProductQuantity($materialId, $quantity)
    {
        if ($quantity !== null) {
            $product = stockValue::where('material_id', $materialId)->first();
            if ($product) {
                $product->cur_qty -= $quantity;
                $product->sale_qty += $quantity;
                $product->save();
            }
        }
    }




}
