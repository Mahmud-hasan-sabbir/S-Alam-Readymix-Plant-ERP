<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\datasetting\category;
use App\Models\datasetting\materials;
use App\Models\datasetting\unit;
use App\Helpers\Helper;
use App\Models\purchase\Purchase;
use App\Models\SallerInformation;
use App\Models\datasetting\storeName;
use Illuminate\Support\Facades\Auth;
use App\Models\purchase\purchaseDetails;
use App\Models\stockValue;



class purchaseController extends Controller
{
    public function index()
     {
        $allcategory = category::all();
        $allunit = unit::all();
        $allSupplier = SallerInformation::where('category',1)->get();
        $allstoreName = storeName::all();
        $purchase_codes = Helper::IDGenerator(new Purchase, 'PO_No', 5, 'PO-NO');

        $allPurchase = Purchase::with('supplierName')->latest()->get();
        // dd($allPurchase);



        return view('layouts.pages.purchase.purchase',compact('allcategory','allunit','allSupplier','allstoreName','purchase_codes','allPurchase'));
     }

     public function getMaterials(Request $request)
     {
        $allmaterials = materials::where('category_id',$request->id)->get();
        return response()->json($allmaterials);
     }



        public function storePurchase(Request $request)
        {

            $purchase = new Purchase();
            $purchase->PO_No = $request->po_no;
            $purchase->order_date = $request->inv_date;
            $purchase->supplier_id = $request->supplier_name;
            $purchase->Total_purchase_amount = $request->netamount;
            $purchase->discount = $request->discount;
            $purchase->status = 0;
            $purchase->is_approve = 0;
            $purchase->remarks = $request->remarks;
            $purchase->user_id = Auth::user()->id;
            $purchase->save();

            foreach ($request->category_id as $key => $category_id) {
                $purchaseDetail = new PurchaseDetails();
                $purchaseDetail->purchase_id = $purchase->id;
                $purchaseDetail->category_id = $category_id;
                $purchaseDetail->material_id = $request->product_id[$key];
                $purchaseDetail->store_id = $request->store_id[$key];
                $purchaseDetail->unit_id = $request->unit_id[$key];
                $purchaseDetail->challan_no = $request->challan_no[$key];
                $purchaseDetail->truck_no = $request->truck_no[$key];
                $purchaseDetail->Qty = $request->quantity[$key];
                $purchaseDetail->unit_price = $request->unit_price[$key];
                $purchaseDetail->truck_fee = $request->truck_fee[$key];
                $purchaseDetail->sub_total = $request->sub_total[$key];
                $purchaseDetail->save();


                $stockValue = StockValue::where('material_id', $request->product_id[$key])->first();

                if ($stockValue) {
                    $stockValue->pur_qty += $request->quantity[$key];
                    $stockValue->cur_qty += $request->quantity[$key];


                    $existingStores = explode(',', $stockValue->store_id);
                    if (!in_array($request->store_id[$key], $existingStores)) {
                        $existingStores[] = $request->store_id[$key];
                        $stockValue->store_id = implode(',', $existingStores);
                    }
                } else {

                    $stockValue = new StockValue();
                    $stockValue->material_id = $request->product_id[$key];
                    $stockValue->store_id = $request->store_id[$key];
                    $stockValue->pur_qty = $request->quantity[$key];
                    $stockValue->sale_qty = 0;
                    $stockValue->cur_qty = $request->quantity[$key];
                    $stockValue->user_id = Auth::user()->id;
                }
                $stockValue->save();
            }

            $notification = ['message' => 'Purchase saved successfully', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        }



        public function purchaseApproveList()
        {
            $allPurchase = Purchase::with('supplierName')->with('storeName')->where('is_approve',0)->latest()->get();
            return view('layouts.pages.purchase.purchase_approve_list',compact('allPurchase'));
        }

        public function purchaseApprove($id)
        {
            Purchase::where('id', $id)->update(['is_approve' => 1,'status' => 2]);
            $notification = ['messege' => 'Purchase Approve successfully', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        }

        public function purchaseCalcaled($id)
        {
            Purchase::where('id', $id)->delete();
            $notification = ['messege' => 'Purchase Calcaled successfully', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        }

        public function PurchaseEdit(Request $request)
        {
            $purchaseEdit = Purchase::with('purchaseDetails.category','purchaseDetails.material','purchaseDetails.store','purchaseDetails.unit')->where('id',$request->id)->first();
            // dd($purchaseEdit);
            $purchaseDetails = $purchaseEdit->purchaseDetails;
            $allcategory = category::all();
            $allunit = unit::all();
            $allSupplier = SallerInformation::where('category',1)->get();
            $allstoreName = storeName::all();
            return response()->json(
                [
                    'purchaseEdit' => $purchaseEdit,
                    'purchaseDetails' => $purchaseDetails,

                ]
            );
            // return view('layouts.pages.purchase.purchase_edit',compact('purchaseEdit','allSupplier','allstoreName','purchaseDetails','allcategory','allunit'));

        }

        public function updatePurchaseEdit(Request $request)
        {
            
            $purchaseupdate = Purchase::findOrFail($request->hiddenid);
            $purchaseupdate->PO_No = $request->po_no;
            $purchaseupdate->order_date = $request->inv_date;
            $purchaseupdate->supplier_id = $request->supplier_id;
            $purchaseupdate->Total_purchase_amount = $request->total_amount;
            $purchaseupdate->discount = $request->discount;
            $purchaseupdate->status = 0;
            $purchaseupdate->is_approve = 0;
            $purchaseupdate->remarks = $request->remarks;
            $purchaseupdate->user_id = Auth::user()->id;
            $purchaseupdate->save();

            // Update or create purchase details
            $existingIds = [];

            // Get the data from the request
            $categoryIds = $request->category_id;
            $materialIds = $request->material_id;
            $storeIds = $request->store_id;
            $unitIds = $request->unit_id;
            $challanNos = $request->challan_no;
            $truckNos = $request->truck_no;
            $quantities = $request->quantityedit;
            $unitPrices = $request->unit_price_edit;
            $truckFees = $request->truckfeeedit;
            $subTotals = $request->sub_totaledit;

            // Loop through the data and update or create purchase details
            for ($i = 0; $i < count($categoryIds); $i++) {
                $purdetailsdata = PurchaseDetails::updateOrCreate(
                    [
                        'id' => $request->data[$i]['id'] ?? null,
                    ],
                    [
                        'purchase_id' => $purchaseupdate->id,
                        'category_id' => $categoryIds[$i],
                        'material_id' => $materialIds[$i],
                        'store_id' => $storeIds[$i],
                        'unit_id' => $unitIds[$i],
                        'challan_no' => $challanNos[$i],
                        'truck_no' => $truckNos[$i],
                        'Qty' => $quantities[$i],
                        'unit_price' => $unitPrices[$i],
                        'truck_fee' => $truckFees[$i],
                        'sub_total' => $subTotals[$i],
                    ]
                );

                $existingIds[] = $purdetailsdata->id;
            }

            // Delete any purchase details that were not included in the update
            PurchaseDetails::where('purchase_id', $purchaseupdate->id)
                ->whereNotIn('id', $existingIds)
                ->delete();

            $notification = ['messege' => 'Purchase updated successfully', 'alert-type' => 'success'];
            return redirect()->route('purchase')->with($notification);
        }



        public function purchaseView($id)
        {
            $purchaseEdit = Purchase::with('purchaseDetails.material')->where('id',$id)->first();
            $purchaseDetails = $purchaseEdit->purchaseDetails;
            $allcategory = category::all();
            $allunit = unit::all();
            $allSupplier = SallerInformation::where('category',1)->get();
            $allstoreName = storeName::all();
            return view('layouts.pages.purchase.purchase_view',compact('purchaseEdit','allSupplier','allstoreName','purchaseDetails','allcategory','allunit'));
        }

        public function purchaseApproveView(Request $request)
        {
            $purchaseapproveview = Purchase::with('supplierName')->with('purchaseDetails.category','purchaseDetails.material','purchaseDetails.store','purchaseDetails.unit')->where('id', $request->id)->first();
            $purDetails = $purchaseapproveview->purchaseDetails;
            $suppliername = $purchaseapproveview->supplierName->company_name;
            return response()->json([
                'purchaseapproveview' => $purchaseapproveview,
                'purDetails' => $purDetails,
                'suppliername' => $suppliername,
            ]);
        }



}
