<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\payment\PaymentLand;
use Illuminate\Support\Facades\Auth;
use App\Models\member\memberDeed;
use App\Models\SallerInformation;
use App\Models\paymentType;
use App\Models\land\DeedDetails;
use App\Models\Accounts\tbl_coa;
use App\Models\payment_for_association;
use App\Models\land\landDetails;
use App\Models\deedLandLeach;

class PaymentRecivedController extends Controller
{
    public function storePaymentLand(Request $request,$pur_type)
    {
        // dd($request->all());
        $payTypeArray = explode(",", $request->pay_type);
        $storePayment = new PaymentLand();
        $storePayment->member_id = $request->member_id;
        $storePayment->land_id = $request->land_id;
        if ($pur_type == 2) {
            $storePayment->land_id = $request->land_id;
            $storePayment->ploat_id = $request->ploat_id;
        } else {
            $storePayment->land_id = $request->land_id;
            $storePayment->ploat_id = 0;
        }

        $storePayment->purchase_type = $pur_type;
        $storePayment->pay_mode = $request->Pay_mode;
        $storePayment->check_num = $request->check_num;
        $storePayment->check_date = $request->check_date;
        $storePayment->pay_type = $payTypeArray[1];
        $storePayment->ledger_code = $payTypeArray[0];
        $storePayment->pay_amount = $request->pay_amount;
        $storePayment->pay_date = $request->pay_date;
        $storePayment->recived_by = $request->recived_by;
        $storePayment->mem_bayna_id = $request->baynaId;
        $storePayment->is_approve = 0;
        $storePayment->remarks = $request->remarks;
        $storePayment->user_id  = Auth::user()->id;
        $storePayment->save();
        return redirect()->back();
    }

    public function getBaynaLand(Request $request)
    {
        $getBaynaLand = memberDeed::with('landDetail')->where('member_id',$request->id)->get();
        return view('layouts.pages.member.payment.get_bayna_land',['getBaynaLand'=>$getBaynaLand]);
    }

    public function getBaynaPloat(Request $request)
    {
        $getBaynaLand = memberDeed::with('landDetail')->where('member_id', $request->id)
                           ->where('ploat_id', '>', 0)
                           ->get();
        return view('layouts.pages.member.payment.get_bayna_ploat',['getBaynaLand'=>$getBaynaLand]);
    }


    public function getBaynaPlot(Request $request)
    {
        $getBaynaPlot = memberDeed::with('ploatname')->where('land_id', $request->id)
                           ->where('ploat_id', '>', 0)
                           ->get();

                        //    dd($getBaynaPlot);

        return view('layouts.pages.member.payment.get_bayna_plot',['getBaynaPlot'=>$getBaynaPlot]);
    }




    // ========================== payment approve function ============================

    public function paymentApprove()
    {
        $allPayment = PaymentLand::with('memberName')->where('is_approve',0)->get();
        return view('layouts.pages.member.payment.payment_approve',['allPayment' => $allPayment]);
    }

    public function paymentApproved($id)
    {
        // $data = PaymentLand::where('id', $id)->first();
        PaymentLand::where('id', $id)->update(['is_approve' => 1]);
        $notification = ['messege' => 'Payment approved successfully!', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function paymentCalcaled($id)
    {
        // $data = PaymentLand::where('id', $id)->first();
        PaymentLand::where('id', $id)->update(['is_approve' => 2]);
        $notification = ['messege' => 'Payment cancaled successfully!', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function approveView(Request $request)
    {
        $allPayment = PaymentLand::with('memberName')->with('employeeName')->where('id', $request->id)->first();
        $memberName = $allPayment->memberName->Saller_name;
        $reciverName = $allPayment->employeeName->Saller_name;
        return response()->json([
            'allPayment'=>$allPayment,
            'memberName'=>$memberName,
            'reciverName'=>$reciverName,
        ]);
    }

    // ========================== payment index function ============================

    public function paymentIndex($type)
    {
        $allEmployee = SallerInformation:: where('Category',2)->get();
        // dd($allEmployee);
        $allMember = SallerInformation::where('Category',1)->get();
        $allLeachman = SallerInformation::where('Category',5)->get();

        $paymentList = PaymentLand::with('memberName')->with('employeeName')->where('purchase_type',$type)->get();
        // $paymentType = paymentType::where('type_category',$type)->where('status','active')->get();
        $memberPaymentType = tbl_coa::where('PHeadName','Sales Account')->get();
        $leachPaymentType = tbl_coa::where('PHeadName','Other Income')->get();
        // dd($memberPaymentType);
        if($type == 4)
        {
            return view('layouts.pages.leach.payment.leach_payment_index',['type'=>$type,'allLeachman' => $allLeachman,'paymentList'=>$paymentList,'allEmployee'=>$allEmployee,'leachPaymentType'=>$leachPaymentType]);
        }else{
            return view('layouts.pages.member.payment.payment_index',['type'=>$type,'allmember' => $allMember,'paymentList'=>$paymentList,'allEmployee'=>$allEmployee,'memberPaymentType'=>$memberPaymentType]);
        }


    }
    public function paymentEdit(Request $request)
    {
        // $type = $request->type;

        $paymentEdit = PaymentLand::where('id',$request->id)->first();

        return response()->json($paymentEdit);
    }
    public function updatePayment(Request $request,$pur_type)
    {
        $payTypeArray = explode(",", $request->pay_type);
        $updatePayment = PaymentLand::where('id',$request->hiddenId)->first();
        $updatePayment->member_id = $request->member_id;
        $updatePayment->land_id = $request->land_id;
        $updatePayment->purchase_type = $pur_type;
        $updatePayment->pay_mode = $request->Pay_mode;

        if ($request->Pay_mode == 'Cash') {
            $updatePayment->check_date = null;
            $updatePayment->check_num = null;
        } else {
            // If pay_mode is not "cash", update other fields
            $updatePayment->check_date = $request->check_date;
            $updatePayment->check_num = $request->check_num;
        }

        $updatePayment->pay_type = $payTypeArray[1];
        $updatePayment->ledger_code = $payTypeArray[0];
        $updatePayment->pay_amount = $request->pay_amount;
        $updatePayment->pay_date = $request->pay_date;
        $updatePayment->recived_by = $request->recived_by;
        $updatePayment->mem_bayna_id = $request->baynaId;
        $updatePayment->is_approve = 0;
        $updatePayment->remarks = $request->remarks;
        $updatePayment->user_id  = Auth::user()->id;
        $updatePayment->save();
        return redirect()->back();
    }

    public function paymentView(Request $request)
    {
        $paymentView = PaymentLand::with('landName')->where('id',$request->id)->first();
        $paymentViewRS_num = $paymentView->landName->RS_num;
        $paymentViewCS_num = $paymentView->landName->CS_num;
        $paymentViewSA_num = $paymentView->landName->SA_num;
        $paymentViewBRS_num = $paymentView->landName->BRS_num;
        $paymentViewMouza = $paymentView->landName->Mouza_name;

        return response()->json([
            'paymentView' => $paymentView,
            'paymentViewRS_num' => $paymentViewRS_num,
            'paymentViewCS_num' => $paymentViewCS_num,
            'paymentViewMouza' => $paymentViewMouza,
            'paymentViewSA_num' => $paymentViewSA_num,
            'paymentViewBRS_num' => $paymentViewBRS_num,
        ]);
    }

    // =============================== payment type function ===============================

    public function paymentType()
    {
        $allPaymentType = paymentType::orderBy('id','DESC')->get();
        // dd($allPaymentType);
        return view('layouts.pages.member.payment.payment_type',['allPaymentType'=>$allPaymentType]);
    }
    public function storePaymentType(Request $request)
    {
        $storePaymentType = new paymentType();
        $storePaymentType->type_category = $request->category_name;
        $storePaymentType->type_name = $request->Payment_type_name;
        $storePaymentType->remarks = $request->remarks;
        $storePaymentType->status = $request->status;
        $storePaymentType->save();
        return redirect()->back();
    }

    public function PaymentTypeEdit(Request $request)
    {
        $paymentTypeEdit = paymentType::where('id',$request->id)->first();
        return response()->json($paymentTypeEdit);
    }
    public function updatePaymentType(Request $request)
    {
        $updatePaymentType = paymentType::where('id',$request->hidden_name)->first();
        $updatePaymentType->type_category = $request->category_namee;
        $updatePaymentType->type_name = $request->Payment_type_namee;
        $updatePaymentType->remarks = $request->remarkss;
        $updatePaymentType->status = $request->statuss;
        $updatePaymentType->save();
        return redirect()->back();
    }

    // ===================================== supplier land payment ==============================

       public function supplierLandPayment()
       {
            $allSupplierPayment = payment_for_association::with('supplierName')->with('landDetails')->latest()->get();
            $purchaseLedger = tbl_coa::where('PHeadName', 'Purchase')->get();
            $bankName = tbl_coa::where('PHeadName', 'cash at bank')->get();
            $alldeedmedia = SallerInformation::where('Category',4)->get();
            // dd($alldeedmedia);

            return view('layouts.pages.accounts.paymentpayable.supplier_land_payment',['alldeedmedia'=>$alldeedmedia,'purchaseLedger'=>$purchaseLedger,'bankName'=>$bankName,'allSupplierPayment' => $allSupplierPayment]);

       }

       public function storeAssociationPayment(Request $request)
       {
            $payTypeArray = explode(",", $request->pay_type);
            $storePaymentassocacation = new payment_for_association();
            $storePaymentassocacation->supplier_id = $request->supplier_id;
            $storePaymentassocacation->land_id = $request->land_id;
            $storePaymentassocacation->pay_mode = $request->Pay_mode;
            $storePaymentassocacation->bank_headCode = $request->bank_headCode;
            $storePaymentassocacation->pay_date = $request->pay_date;
            $storePaymentassocacation->pay_type = $payTypeArray[1];
            $storePaymentassocacation->pay_type_code =  $payTypeArray[0];
            $storePaymentassocacation->check_num = $request->check_num;
            $storePaymentassocacation->check_date = $request->check_date;
            $storePaymentassocacation->pay_amount = $request->pay_amount;
            $storePaymentassocacation->remarks = $request->remarks;
            $storePaymentassocacation->user_id  = Auth::user()->id;
            $storePaymentassocacation->save();
            $notification = ['messege' => 'assocacation payment successfully.!', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
       }

       public function supplierLandPaymentApprove()
       {
            $SupplierPaymentApprove = payment_for_association::with('supplierName')->with('landDetails')->where('is_approve',0)->latest()->get();
            return view('layouts.pages.accounts.paymentpayable.supplier_land_payment_approve',['SupplierPaymentApprove' => $SupplierPaymentApprove]);
       }

       public function supplierPaymentApprove($id)
       {
            payment_for_association::where('id', $id)->update(['is_approve' => 1]);
            $notification = ['messege' => 'Supplier Payment approved successfully!', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
       }

       public function supplierPaymentCancale($id)
       {
            payment_for_association::where('id', $id)->update(['is_approve' => 2]);
            $notification = ['messege' => 'Supplier Payment cancaled successfully!', 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
       }

       public function supplierPaymentEdit(Request $request)
       {
            $supplierPaymentEdit = payment_for_association::where('id',$request->id)->first();
            return response()->json($supplierPaymentEdit);
       }

       public function getSupplierLand(Request $request)
       {
            $supplierLand = DeedDetails::with('landDetails')->where('media_id',$request->id)->get();
            return view('layouts.pages.accounts.paymentpayable.get_supplier_land',['supplierLand'=>$supplierLand]);

       }


       public function getDeedDetailsLand(Request $request)
       {
            $deedDetailsLand = DeedDetails::with('landDetails')->where('land_owner_id',$request->id)->get();
            return view('layouts.pages.accounts.paymentpayable.get_deed_details_land',['deedDetailsLand'=>$deedDetailsLand]);
       }

       public function getMemberDeedLand(Request $request)
       {
            $memberLandEdit = memberDeed::with('landDetail')->where('member_id',$request->id)->get();
            return view('layouts.pages.member.payment.load_member_edit_land',['memberLandEdit'=>$memberLandEdit]);
       }

       public function updateSupplierLandPayment(Request $request)
    {
        $payTypeArray = explode(",", $request->pay_type);
        $updatesupLandPayment = payment_for_association::where('id', $request->hiddenId)->first();
        $updatesupLandPayment->supplier_id = $request->supplier_id;
        $updatesupLandPayment->land_id = $request->land_id;
        $updatesupLandPayment->pay_mode = $request->pay_mode;



        // Check if pay_mode is "cash" before updating check_date, check_number, and bankHead_code
        if ($request->pay_mode == 'Cash') {
            $updatesupLandPayment->check_date = null;
            $updatesupLandPayment->check_num = null;
            $updatesupLandPayment->bank_headCode = null;
        } else {
            // If pay_mode is not "cash", update other fields
            $updatesupLandPayment->check_date = $request->check_date;
            $updatesupLandPayment->check_num = $request->check_num;
            $updatesupLandPayment->bank_headCode = $request->bank_headCode;
        }


        $updatesupLandPayment->pay_date = $request->pay_date;
        $updatesupLandPayment->pay_type = $payTypeArray[1];
        $updatesupLandPayment->pay_type_code =  $payTypeArray[0];
        $updatesupLandPayment->pay_amount = $request->pay_amount;
        $updatesupLandPayment->remarks = $request->remarks;
        $updatesupLandPayment->user_id  = Auth::user()->id;
        $updatesupLandPayment->save();

        $notification = ['message' => 'association payment update successfully!', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }


    public function supplierPaymentView(Request $request)
    {
        $supplierPaymentView = payment_for_association::with('supplierName')->with('landDetails')->with('bankName')->where('id',$request->id)->first();
        $landDetailsCS = $supplierPaymentView->landDetails->CS_num;
        $landDetailsRS = $supplierPaymentView->landDetails->RS_num;
        $landDetailsSA = $supplierPaymentView->landDetails->SA_num;
        $landDetailsBRS = $supplierPaymentView->landDetails->BRS_num;
        $landDetailsMouza = $supplierPaymentView->landDetails->Mouza_name;
        $supplierName = $supplierPaymentView->supplierName->Saller_name;



        if($supplierPaymentView->pay_mode == 'Bank'){
            $bankName = $supplierPaymentView->bankName->HeadName;

        }else{
            $bankName = 'Cash';
        }

        return response()->json([
            'supplierPaymentView'=>$supplierPaymentView,
            'landDetailsCS'=>$landDetailsCS,
            'landDetailsRS'=>$landDetailsRS,
            'landDetailsMouza'=>$landDetailsMouza,
            'supplierName'=>$supplierName,
            'bankName'=>$bankName,
            'landDetailsSA'=>$landDetailsSA,
            'landDetailsBRS'=>$landDetailsBRS
        ]);


    }


    public function getLeachLand(Request $request)
    {
        $leachLand = deedLandLeach::with('land')->where('leachman_id',$request->id)->get();
        return response()->json([
            'leachLand'=>$leachLand,

        ]);
        // return view('layouts.pages.accounts.paymentpayable.get_leach_land',['leachLand'=>$leachLand]);
    }



}

