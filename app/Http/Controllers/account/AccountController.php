<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Exception;
use App\Models\accounts\BankInfo;
use App\Models\SallerInformation;
use App\Models\purchase\Purchase;
use App\Models\accounts\paymentForSupplier;
use App\Models\invoice\invoice;
use Illuminate\Support\Facades\Auth;
use App\Models\customerPayment;
use App\Models\transection;
use App\Models\expenseHead;
use App\Models\paymentForExpense;
use App\Models\bankLoan;
use App\Models\paidLoanAmount;



class AccountController extends Controller
{
    public function bankInfo()
    {
        // $allbankinfo = BankInfo::orderBy('id','DESC')->get();
         $allbankinfo = BankInfo::all();
         $banksWithBalances = $allbankinfo->map(function($item) {
            $bankTransactions = Transection::where('StoreId', $item->id)->get();
            $debit = $bankTransactions->sum('Debit');
            $credit = $bankTransactions->sum('Credit');
            $balance = $debit - $credit;
            $item->balance = number_format($balance, 2, '.', ',');
            return $item;
        });
        return view('layouts.pages.accounts.bank-setup.bankInfo',compact('banksWithBalances'));
    }

    public function storeBankInfo(Request $request)
    {
        $bankInfo = new BankInfo();
        $bankInfo->bank_name = $request->bank_name;
        $bankInfo->branch_name = $request->branch_name;
        $bankInfo->acc_no = $request->acc_no;
        $bankInfo->routing_no = $request->routing_no;
        $bankInfo->acc_type = $request->acc_type;
        $bankInfo->holder_name = $request->holder_name;
        $bankInfo->status = 0;
        $bankInfo->is_approve = 0;
        $bankInfo->remarks = $request->remarks;
        $bankInfo->user_id = Auth::user()->id;
        $bankInfo->save();

        $notification = ['messege' => 'Bank Info save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function bankEdit(Request $request)
    {
        $bankedit = BankInfo::where('id',$request->id)->first();
        // dd($bankedit);
        return response()->json($bankedit);
    }

    public function update(Request $request, $id)
    {

        BankInfo::where('id',$id)->update([
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'acc_no' => $request->acc_no,
            'routing_no' => $request->routing_no,
            'acc_type' => $request->acc_type,
            'holder_name' => $request->holder_name,
            'remarks' => $request->remarks,
        ]);
        $notification = ['messege' => 'Bank Info Update Save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
    public function supplerPayment()
    {
        $allSupplier = SallerInformation::where('category',1)->where('Status','Active')->get();
        $allbankName = BankInfo::all();
        $payment = paymentForSupplier::with('supplierName')->latest()->get();
        return view('layouts.pages.accounts.paymentpayable.supplerPayment',compact('allSupplier','allbankName','payment'));
    }

    public function getTotalamountSup(Request $request)
    {

        $totalPurchaseAmount = Purchase::where('supplier_id', $request->id)->where('is_approve', 1)
            ->sum('total_purchase_amount');
        $totalPaymentAmount = PaymentForSupplier::where('supplier_id', $request->id)
            ->sum('pay_amount');
        $amountDue = $totalPurchaseAmount - $totalPaymentAmount;

        return response()->json(['amount_due' => $amountDue]);
    }

    public function getAccNo(Request $request)
    {
        $getAccNO = BankInfo::where('id',$request->id)->first();
        return response()->json($getAccNO);
    }

    public function storePaymentSupplier(Request $request)
    {
        $paymentForSupplier = new paymentForSupplier();
        $paymentForSupplier->supplier_id = $request->supplier_id;
        $paymentForSupplier->po_no = $request->po_no;
        $paymentForSupplier->pay_reason = $request->pay_reason;
        $paymentForSupplier->pay_mode = $request->pay_mode;
        $paymentForSupplier->pay_date = $request->pay_date;
        $paymentForSupplier->bank_name = $request->bank_name;
        $paymentForSupplier->check_num = $request->check_num;
        $paymentForSupplier->check_date = $request->check_date;
        $paymentForSupplier->pay_amount = $request->pay_amount;
        $paymentForSupplier->remarks = $request->remarks;
        $paymentForSupplier->is_approve = 0;
        $paymentForSupplier->user_id = Auth::user()->id;
        $paymentForSupplier->save();

        $notification = ['messege' => 'Payment for Supplier save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function supplierPaymentEdit(Request $request)
    {
        $supplierPaymentEdit = paymentForSupplier::where('id',$request->id)->first();
        // dd($supplierPaymentEdit);

            $totalPurchaseAmount = Purchase::where('supplier_id',$supplierPaymentEdit->supplier_id)->where('is_approve', 1)
            ->sum('total_purchase_amount');
        $totalPaymentAmount = PaymentForSupplier::where('supplier_id', $supplierPaymentEdit->supplier_id)
            ->sum('pay_amount');
        $amountDue = $totalPurchaseAmount - $totalPaymentAmount;

        if($supplierPaymentEdit->pay_mode == 'Cash')
        {
            $value = transection::where('UpdateBy','Cash')->sum('Debit') - transection::where('UpdateBy','Cash')->sum('Credit');
        }else{
            $value = transection::where('StoreID',$supplierPaymentEdit->bank_name)->sum('Debit') - transection::where('StoreID',$supplierPaymentEdit->bank_name)->sum('Credit');
        }




        return response()->json([
            'supplierPaymentEdit' => $supplierPaymentEdit,
            'amountDue' => $amountDue,
            'value' => $value,

        ]);
    }

    public function updateSupplierPayment(Request $request)
    {

        $updateData = [
            'pay_date' => $request->pay_date,
            'pay_amount' => $request->pay_amount,
            'remarks' => $request->remarks,
        ];

        paymentForSupplier::where('id', $request->hidden_id)->update($updateData);


        $notification = ['messege' => 'Payment for Supplier Update Save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function supplierPaymentApproveList()
    {
        $allapprovelist = paymentForSupplier::with('supplierName')->where('is_approve',0)->latest()->get();
        return view('layouts.pages.accounts.paymentpayable.supplierPaymentApproveList',compact('allapprovelist'));
    }

    public function supplierPaymentApprove($id)
    {
        paymentForSupplier::where('id', $id)->update(['is_approve' => 1]);
        $notification = ['messege' => 'payment Approve successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function supplierPaymentCancaled($id)
    {
        paymentForSupplier::where('id', $id)->update(['is_approve' => 2]);
        $notification = ['messege' => 'payment cancaled successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    // customer payment function

    public function coustomerPayment()
    {
        $allCustomer = SallerInformation::where('category',2)->where('Status','Active')->get();
        $allbankName = BankInfo::all();
        $payment = customerPayment::with('customerName')->latest()->get();
        return view('layouts.pages.accounts.paymentreceivable.customerPayment',compact('allCustomer','allbankName','payment'));
    }

    public function getcusTotalamount(Request $request)
    {
        $invoices = Invoice::where('cus_id', $request->id)->where('status', 1)->get();

        $totalPurchaseAmount = $invoices->sum(function ($invoice) {
            return floatval(str_replace(',', '', $invoice->total_amount));
        });
        $totalPaymentAmount = CustomerPayment::where('customer_id', $request->id)->sum('pay_amount');
        $amountDue = $totalPurchaseAmount - $totalPaymentAmount;
        $formattedAmountDue = number_format($amountDue, 2, '.', ',');
        return response()->json(['amount_due' => $formattedAmountDue]);
    }

    public function storePaymentCustomer(Request $request)
    {
        $paymentForcustomer = new customerPayment();
        $paymentForcustomer->customer_id = $request->customer_id;
        $paymentForcustomer->inv_no = $request->po_no;
        $paymentForcustomer->pay_reason = $request->pay_reason;
        $paymentForcustomer->pay_mode = $request->pay_mode;
        $paymentForcustomer->pay_date = $request->pay_date;
        $paymentForcustomer->bank_name = $request->bank_name;
        $paymentForcustomer->check_num = $request->check_num;
        $paymentForcustomer->check_date = $request->check_date;
        $paymentForcustomer->pay_amount = $request->pay_amount;
        $paymentForcustomer->remarks = $request->remarks;
        $paymentForcustomer->is_approve = 0;
        $paymentForcustomer->user_id = Auth::user()->id;
        $paymentForcustomer->save();

        $notification = ['messege' => 'Customer Payment save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }


    public function customerPaymentEdit(Request $request)
    {
        $customerPaymentEdit = customerPayment::with('custotalamount')->where('id',$request->id)->first();
        $custotalamm = $customerPaymentEdit->custotalamount->sum('total_amount');

        return response()->json([

            'customerPaymentEdit' => $customerPaymentEdit,
            'custotalamm' => $custotalamm,
        ]);
    }

    public function updateCustomerPayment(Request $request)
    {
        $updateData = [
            'customer_id' => $request->supplier_id,
            'inv_no' => $request->po_no,
            'pay_reason' => $request->pay_reason,
            'pay_mode' => $request->pay_mode,
            'pay_date' => $request->pay_date,
            'pay_amount' => $request->pay_amount,
            'remarks' => $request->remarks,
        ];

        if ($request->pay_mode == 'Cash') {
            $updateData['check_date'] = null;
            $updateData['check_num'] = null;
            $updateData['bank_name'] = null;
        } else {
            $updateData['check_date'] = $request->check_date;
            $updateData['check_num'] = $request->check_num;
            $updateData['bank_name'] = $request->bank_name;
        }

        customerPayment::where('id', $request->hidden_id)->update($updateData);


        $notification = ['messege' => 'Payment for customer Update Save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function coustomerPaymentApproveList()
    {
        $allapprovelist = customerPayment::with('customerName')->where('is_approve',0)->latest()->get();
        return view('layouts.pages.accounts.paymentreceivable.coustomerPaymentApproveList',compact('allapprovelist'));
    }

    public function coustomerPaymentApprove($id)
    {
        customerPayment::where('id', $id)->update(['is_approve' => 1]);
        $notification = ['messege' => 'payment Approve successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function coustomerPaymentCancaled($id)
    {
        customerPayment::where('id', $id)->update(['is_approve' => 2]);
        $notification = ['messege' => 'payment cancaled successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    // opening balance function

    public function openingBalance()
    {
        $allbankName = BankInfo::all();
        return view('layouts.pages.accounts.openingBalance.openingBalance',compact('allbankName'));
    }

    public function storeOpeningBalance(Request $request)
    {
        try{


            $openingBalance = new transection();
            if($request->account_type == 'Cash')
            {
                $openingBalance->UpdateBy = $request->account_type;
                $openingBalance->StoreID = 0;
            }else
            {
                $openingBalance->UpdateBy = 'Bank';
                $openingBalance->StoreID = $request->account_type;
            }

            $openingBalance->Member_code = 0;
            if($request->opening_type == 'Debit')
            {
                $openingBalance->Vtype = $request->opening_type;
            }
            else{

                $openingBalance->Vtype = $request->opening_type;
            }

            if($request->opening_type == 'Debit')
            {
                $openingBalance->Debit = $request->opening_balance;
                $openingBalance->Credit = 0;
            }
            else{
                $openingBalance->Debit = 0;
                $openingBalance->Credit = $request->opening_balance;
            }

            $openingBalance->VDate = $request->opening_date;
            $openingBalance->Description = 'Opening Balance';
            $openingBalance->CreateBy = Auth::user()->id;
            $openingBalance->save();
            $notification = ['messege' => 'Opening balance has been saved successfully', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);

        }catch(Exception $e){
            return $e->getMessage();
        }
    }


    public function getCurrentaccountCash(Request $request)
    {
       if($request->id == 'Cash')
       {
        $cashvalue = transection::where('UpdateBy','Cash')->sum('Debit') - transection::where('UpdateBy','Cash')->sum('Credit');
       }else{
        $cashvalue = 0;
       }

         return response()->json([
            'totalAmount' => $cashvalue,

         ]);


    }


    public function getCurrentaccountBank(Request $request)
    {
        $bankvalue = transection::where('StoreID',$request->id)->sum('Debit') - transection::where('StoreID',$request->id)->sum('Credit');
        return response()->json([
            'totalAmount' => $bankvalue,

         ]);
    }

    //expense function

    public function expenseHead()
    {
        $allexpense = expenseHead::all();
        return view('layouts.pages.accounts.expense.expenseHead',compact('allexpense'));
    }

    public function storeExpenseHead(Request $request)
    {
        $expenseHead = new expenseHead();
        $expenseHead->name = $request->name;
        $expenseHead->description = $request->description;
        $expenseHead->status = 1;
        $expenseHead->save();

        $notification = ['messege' => 'Expense Head save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function getExHeadedit(Request $request)
    {
        $editexhead = expenseHead::where('id',$request->id)->first();
        return response()->json($editexhead);
    }

    public function updateExpenseHead(Request $request)
    {
        expenseHead::where('id',$request->hideId)->update([
            'name' => $request->newName,
            'description' => $request->newRemarks,
            'status' => $request->newStatus,
        ]);
        $notification = ['messege' => 'Expense Head Update Save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function comExpense()
    {
        $headname = expenseHead::all();
        $allbankName = BankInfo::all();
        $allexpense = paymentForExpense::with('expenseHead')->latest()->get();
        return view('layouts.pages.accounts.expense.comexpense',compact('headname','allbankName','allexpense'));
    }

    public function storeCoExpense(Request $request)
    {
        $storecoexpense = new paymentForExpense();
        $storecoexpense->ex_head_id = $request->head_id;
        $storecoexpense->pay_reason = $request->pay_reason;
        $storecoexpense->pay_mode = $request->pay_mode;
        $storecoexpense->pay_date = $request->pay_date;
        $storecoexpense->bank_name = $request->bank_name;
        $storecoexpense->check_num = $request->check_num;
        $storecoexpense->check_date = $request->check_date;
        $storecoexpense->pay_amount = $request->pay_amount;
        $storecoexpense->remarks = $request->remarks;
        $storecoexpense->is_approve = 0;
        $storecoexpense->user_id = Auth::user()->id;
        $storecoexpense->save();
        $notification = ['messege' => 'Expense Payment save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);



    }


    public function expensePaymentEdit(Request $request)
    {
        $editexpense = paymentForExpense::where('id',$request->id)->first();

        if($editexpense->pay_mode == 'Cash')
        {
            $value = transection::where('UpdateBy','Cash')->sum('Debit') - transection::where('UpdateBy','Cash')->sum('Credit');
        }else{
            $value = transection::where('StoreID',$editexpense->bank_name)->sum('Debit') - transection::where('StoreID',$editexpense->bank_name)->sum('Credit');
        }


        return response()->json([
            'editexpense' => $editexpense,
            'value' => $value,
        ]);
    }


    public function updateCoExpense(Request $request)
    {
        paymentForExpense::where('id', $request->hidden_id)->update([
            'pay_date' => $request->pay_date,
            'pay_amount' => $request->pay_amountedit,
            'remarks' => $request->remarks,
        ]);


        $notification = ['messege' => 'Payment for expense Update Save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function expenseApproveList()
    {
        $allapprovelist = paymentForExpense::with('expenseHead')->where('is_approve',0)->latest()->get();
        return view('layouts.pages.accounts.expense.expenseApproveList',compact('allapprovelist'));
    }

    public function getCoexpenseView(Request $request)
    {
        $getCoexpenseview = paymentForExpense::with('expenseHead','bankname')->where('id', $request->id)->first();


        $headname = $getCoexpenseview->expenseHead->name ?? 'N/A';
        $bankname = $getCoexpenseview->bankname->bank_name ?? 'N/A';

        return response()->json([
            'getCoexpenseview' => $getCoexpenseview,
            'headname' => $headname,
            'bankname' => $bankname,
        ]);
    }


    public function expensePaymentApprove($id)
    {
        paymentForExpense::where('id', $id)->update(['is_approve' => 1]);
        $notification = ['messege' => 'expense Approve successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function expensePaymentCancaled($id)
    {
        paymentForExpense::where('id', $id)->update(['is_approve' => 2]);
        $notification = ['messege' => 'expense cancaled successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }


    public function fundtransfer()
    {
        $allbankName = BankInfo::all();
        return view('layouts.pages.accounts.fundTransfer.fundTransfer',compact('allbankName'));
    }

    public function getCurrentaccountBalance(Request $request)
    {
       if($request->id == 'Cash')
       {
        $value = transection::where('UpdateBy','Cash')->sum('Debit') - transection::where('UpdateBy','Cash')->sum('Credit');
       }else{

        $value = transection::where('StoreID',$request->id)->sum('Debit') - transection::where('StoreID',$request->id)->sum('Credit');
       }

         return response()->json([
            'totalAmount' => $value,

         ]);


    }


    public function storeFundTransfer(Request $request)
    {

        $loopdata = $request->data;

        foreach ($loopdata as $transactionData) {
            $transaction = new Transection();
            $transaction->Vtype = 'Fund Transfer';
            $transaction->VDate = $transactionData['date'];

            if ($transactionData['trans_name'] == 'Cash') {
                $transaction->UpdateBy = 'Cash';
                $transaction->StoreID = 0;
                $transaction->Description = 'Fund Transfer To Bank';

            } else {
                $transaction->UpdateBy = 'Bank';
                $transaction->StoreID = $transactionData['trans_name'];
                $transaction->Description = 'Fund Transfer To Cash';
            }

            $transaction->Debit = $transactionData['debit'] ?? 0;
            $transaction->Credit = $transactionData['credit'] ?? 0;
            $transaction->save();
        }

        $notification = [
            'messege' => 'Fund Transfer successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function loan()
    {
        $allbankName = BankInfo::all();
        $allloan = bankLoan::with('bank')->latest()->get();
        return view('layouts.pages.accounts.loan.loan',compact('allbankName','allloan'));
    }


    public function storeInvestloan(Request $request)
    {
        $storeloan = new bankLoan();
        $storeloan->bank_id = $request->bank_id;
        $storeloan->acc_no = $request->acc_no;
        $storeloan->year_of_loan = $request->year_of_loan;
        $storeloan->loan_amount = $request->loan_amount;
        $storeloan->interest_loan = $request->interest_loan;
        $storeloan->start_date = $request->start_date;
        $storeloan->end_date = $request->end_date;
        $storeloan->remarks = $request->remarks;
        $storeloan->year = $request->year;
        $storeloan->is_approve = 0;
        $storeloan->user_id = Auth::user()->id;
        $storeloan->save();
        $notification = ['messege' => 'Loan save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }


    public function editBankLoan(Request $request)
    {
        $editloan = bankLoan::where('id',$request->id)->first();
        return response()->json($editloan);
    }

    public function updateBankLoan(Request $request,$id)
    {
       
        bankLoan::where('id',$id)->update([
            'bank_id' => $request->bank_id,
            'acc_no' => $request->acc_no,
            'year_of_loan' => $request->year_of_loan,
            'loan_amount' => $request->loan_amount,
            'interest_loan' => $request->interest_loan,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'remarks' => $request->remarks,
            'year' => $request->year,
            'is_approve' => 0,
        ]);
        $notification = ['messege' => 'Loan Update Save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function loanApprovelist()
    {
        $allapprovelist = bankLoan::with('bank')->where('is_approve',0)->latest()->get();
        return view('layouts.pages.accounts.loan.loanApproveList',compact('allapprovelist'));
    }

    public function bankloanApprove($id)
    {
        bankLoan::where('id', $id)->update(['is_approve' => 1]);
        $notification = ['messege' => 'bank loan Approve successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function bankloanCancaled($id)
    {
        bankLoan::where('id', $id)->update(['is_approve' => 2]);
        $notification = ['messege' => 'bank loan cancaled successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function loanPaidForBank()
    {
        $allbankName = BankInfo::all();
        $paidloan = paidLoanAmount::with('bank')->latest()->get();
        return view('layouts.pages.accounts.loan.loanPaidForBank',compact('allbankName','paidloan'));
    }

    public function getBankDetail(Request $request)
    {
        $getdetail = bankLoan::where('bank_id',$request->id)->where('is_approve',1)->get();
        $value = transection::where('StoreID',$request->id)->sum('Debit') - transection::where('StoreID',$request->id)->sum('Credit');

        $totalloanamount = $getdetail->sum('loan_amount');
        $totalinterest = $getdetail->pluck('interest_loan');
        $accno = $getdetail->pluck('acc_no');
        return response()->json([
            'totalloanamount' => $totalloanamount,
            'totalinterest' => $totalinterest[0],
            'totalbankvalue' => $value,
            'accno' => $accno[0],
        ]);
        
    }


    public function storeLoanPaid(Request $request)
    {
        $storeloanpaid = new paidLoanAmount();
        $storeloanpaid->bank_id = $request->bank_id;
        $storeloanpaid->acc_no = $request->acc_no;
        $storeloanpaid->loan_amount = $request->loan_amount;
        $storeloanpaid->interest_loan = $request->interest_loan;
        $storeloanpaid->date = $request->date;
        $storeloanpaid->remarks = $request->remarks;
        $storeloanpaid->year = $request->year;
        $storeloanpaid->pay_loan_amount = $request->pay_loan_amount;
        $storeloanpaid->is_approve = 0;
        $storeloanpaid->user_id = Auth::user()->id;
        $storeloanpaid->save();
        $notification = ['messege' => 'Loan Paid save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }


    public function editPaidBankLoan(Request $request)
    {
        $editloan = paidLoanAmount::where('id',$request->id)->first();
        $value = transection::where('StoreID',$editloan->bank_id)->sum('Debit') - transection::where('StoreID',$editloan->bank_id)->sum('Credit');
        return response()->json([
            'editloan' => $editloan,
            'value' => $value,
        ]);
    }

    public function updateBankLoanPaid(Request $request,$id)
    {
        paidLoanAmount::where('id',$id)->update([
            'bank_id' => $request->bank_id,
            'acc_no' => $request->acc_no,
            'loan_amount' => $request->loan_amount,
            'interest_loan' => $request->interest_loan,
            'date' => $request->date,
            'remarks' => $request->remarks,
            'year' => $request->year,
            'pay_loan_amount' => $request->pay_loan_amount,
            'is_approve' => 0,
        ]);

        $notification = ['messege' => 'Loan Paid Update Save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function loanPaidApprovelist()
    {
        $allapprovelist = paidLoanAmount::with('bank')->where('is_approve',0)->latest()->get();
        return view('layouts.pages.accounts.loan.loanPaidApproveList',compact('allapprovelist'));
    }


    public function paidloanApprove($id)
    {
        paidLoanAmount::where('id', $id)->update(['is_approve' => 1]);
        $notification = ['messege' => 'paid loan Approve successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function paidloanCancaled($id)
    {
        paidLoanAmount::where('id', $id)->update(['is_approve' => 2]);
        $notification = ['messege' => 'paid loan cancaled successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
 













}

