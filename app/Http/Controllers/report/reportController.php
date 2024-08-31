<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SallerInformation;
use App\Models\transection;
use App\Models\datasetting\storeName;
use App\Models\stockValue;
use App\Models\purchase\PurchaseDetails;
use App\Models\accounts\BankInfo;
use Illuminate\Support\Facades\DB;
use App\Models\expenseHead;
use App\Models\advancedSalary;
use App\Models\paidSalary;
use App\Models\purchase\Purchase;
// use Dompdf\Dompdf;
// use Dompdf\Options;
use PDF;
use App\Models\consumption;
use App\Models\invoice\invoice;
use App\Models\invoiceDetail;



class reportController extends Controller
{
    public function supplierWiseReport()
    {
        $allSallerName = SallerInformation::where('category',1)->get();
        return view('layouts.pages.report.supplier_wise_report',compact('allSallerName'));
    }

    public function getSupplierWiseReport(Request $request)
    {

        $getSupplierReport = transection::with('saller')
        ->where('Member_code',$request->supplierId)
        ->whereDate('VDate', '>=', $request->startDate)
        ->whereDate('VDate', '<=', $request->endDate)
        ->get();
        $alldebit =  $getSupplierReport->sum('Debit');
        $allcredit = $getSupplierReport->sum('Credit');
        // dd($getSupplierReport);
        return view('layouts.pages.report.get_supplier_wise_report',compact('getSupplierReport','alldebit','allcredit'));
    }

    public function customerWiseReport()
    {
        $allSallerName = SallerInformation::where('category',2)->get();
        return view('layouts.pages.report.customer_wise_report',compact('allSallerName'));
    }

    public function getCustomerWiseReport(Request $request)
    {
        $getcustomerReport = transection::with('saller')
        ->where('Member_code', $request->customerId)
        ->whereDate('VDate', '>=', $request->startDate)
        ->whereDate('VDate', '<=', $request->endDate)
        ->get();


            $alldebit = $getcustomerReport->sum(function ($transection) {
                return floatval(str_replace(',', '', $transection->Debit));
            });

            $allcredit = $getcustomerReport->sum(function ($transection) {
                return floatval(str_replace(',', '', $transection->Credit));
            });

            $formattedAlldebit = number_format($alldebit, 2, '.', ',');
            $formattedAllcredit = number_format($allcredit, 2, '.', ',');


        return view('layouts.pages.report.get_customer_wise_report',compact('getcustomerReport','formattedAlldebit','formattedAllcredit'));
    }

    public function storeWiseReport()
    {
        $allStoreName = storeName::all();
        return view('layouts.pages.report.store_wise_report',compact('allStoreName'));
    }

    public function getStoreWiseReport(Request $request)
    {
        $storeId = $request->storeId;

        $getStoreReport = StockValue::with('material')->whereRaw("FIND_IN_SET(?, store_id)", [$storeId])->get();

        $pursum = $getStoreReport->sum('pur_qty');
        $salesum = $getStoreReport->sum('sale_qty');


        return view('layouts.pages.report.get_store_wise_report', compact('getStoreReport','pursum','salesum'));
    }

    public function modeWiseReport()
    {
        $bankName = BankInfo::all();
        return view('layouts.pages.report.mode_wise_report',compact('bankName'));
    }

    public function getModeWiseReport(Request $request)
    {
        if($request->headCode == 'Cash') {
            $openBal = DB::table('transections')
                ->selectRaw('IFNULL(SUM(IFNULL(Debit, 0)) - SUM(IFNULL(Credit, 0)), 0) as balance')
                ->where('UpdateBy', $request->headCode)
                ->whereDate('VDate', '<', $request->startDate)
                ->first();
        } else {
            $openBal = DB::table('transections')
                ->selectRaw('IFNULL(SUM(IFNULL(Debit, 0)) - SUM(IFNULL(Credit, 0)), 0) as balance')
                ->where('StoreID', $request->headCode)
                ->whereDate('VDate', '<', $request->startDate)
                ->first();
        }

        DB::statement('SET @CumulativeSum := ?', [$openBal->balance]);

        if($request->headCode == 'Cash') {
            $getmode = transection::where('UpdateBy',$request->headCode)
                ->select('id', 'VDate', 'Description', 'Debit', 'Credit','UpdateBy', DB::raw('(@CumulativeSum := @CumulativeSum + Debit - Credit) as balance'))
                ->whereDate('VDate', '>=', $request->startDate)
                ->whereDate('VDate', '<=', $request->endDate)
                ->get();
        } else {
            $getmode = transection::where('StoreID',$request->headCode)
                ->select('id', 'VDate', 'Description', 'Debit', 'Credit','UpdateBy', DB::raw('(@CumulativeSum := @CumulativeSum + Debit - Credit) as balance'))
                ->whereDate('VDate', '>=', $request->startDate)
                ->whereDate('VDate', '<=', $request->endDate)
                ->get();
        }

        DB::statement('SET @CumulativeSum = 0');

        $totalBalance = 0;

        foreach ($getmode as $item) {
            $totalBalance = $item->balance;
        }


        $debitSum = $getmode->where('Debit', '>', 0)->sum('Debit');
        $creditSum = $getmode->where('Credit', '>', 0)->sum('Credit');

        return view('layouts.pages.report.load_mode_wise_report', compact('getmode', 'debitSum', 'creditSum', 'openBal', 'totalBalance'));
    }


    public function headWiseReport()
    {
        $allhead = expenseHead::all();
        return view('layouts.pages.report.head_wise_report',compact('allhead'));
    }

    public function getHeadWiseReport(Request $request)
    {
        $getexpense = transection::where('HeadCode',$request->headCode)
                ->whereDate('VDate', '>=', $request->startDate)
                ->whereDate('VDate', '<=', $request->endDate)
                ->get();



        $totalCredit = $getexpense->sum('Credit');

        return view('layouts.pages.report.load_head_wise_report', compact('getexpense','totalCredit'));
    }


    public function advancedSalaryReport()
    {
        return view('layouts.pages.report.advanced_salary_report');
    }

    public function getAdvancedSalaryReport(Request $request)
    {
        $getadsalaryreport = advancedSalary::with('employee')->where('month',$request->month)->where('year',$request->year)->get();
        $totaladvanced = $getadsalaryreport->sum('advanced_salary');
        return view('layouts.pages.report.load_advanced_salary_report',compact('getadsalaryreport','totaladvanced'));

    }

    public function paidSalaryReport()
    {
        return view('layouts.pages.report.paid_salary_report');
    }

    public function getPaidSalaryReport(Request $request)
    {
        $getpaidSalary = paidSalary::with('employee')->where('month',$request->month)->where('year',$request->year)->get();
        $totalpaid = $getpaidSalary->sum('paid_salary');
        return view('layouts.pages.report.load_paid_salary_report', compact('getpaidSalary','totalpaid'));
    }


    public function totalSupplierReport()
    {

        $supplierIds = SallerInformation::where('Category', 1)->pluck('id');
        $totalSupplierReport = transection::with('saller')
        ->whereIn('Member_code', $supplierIds)
        ->select('Member_code', DB::raw('SUM(Debit) as total_debit'), DB::raw('SUM(Credit) as total_credit'))
        ->groupBy('Member_code')
        ->get();

        return view('layouts.pages.report.totalSupplierReport', compact('totalSupplierReport'));
    }


    public function allCustomerReport()
    {
        $customerIds = SallerInformation::where('Category', 2)->pluck('id');
        $transactions = transection::with('saller')
            ->whereIn('Member_code', $customerIds)
            ->get();
        $totalcustomerReport = $transactions->groupBy('Member_code')->map(function ($transactions) {
            $totalDebit = $transactions->sum(function ($transaction) {
                return floatval(str_replace(',', '', $transaction->Debit));
            });
            $totalCredit = $transactions->sum(function ($transaction) {
                return floatval(str_replace(',', '', $transaction->Credit));
            });

            return [
                'Member_code' => $transactions->first()->Member_code,
                'total_debit' => $totalDebit,
                'total_credit' => $totalCredit,
                'saller' => $transactions->first()->saller,
            ];
        });

        return view('layouts.pages.report.allcustomerReport', [
            'totalcustomerReport' => $totalcustomerReport
        ]);
    }


    public function officeCashReport()
    {
        $debit = transection::where('UpdateBy','Cash')->sum('Debit');
        $credit = transection::where('UpdateBy','Cash')->sum('Credit');
        $formattedAlldebit = number_format($debit, 2, '.', ',');
        $formattedAllcredit = number_format($credit, 2, '.', ',');

        return view('layouts.pages.report.officecashreport',compact('formattedAlldebit','formattedAllcredit'));
    }

    public function bankTotalCal($id)
    {
        $bankid = transection::where('StoreId',$id)->get();
        $debit = $bankid->sum('Debit');
        $credit = $bankid->sum('Credit');
        $formattedAlldebit = number_format($debit, 2, '.', ',');
        $formattedAllcredit = number_format($credit, 2, '.', ',');

        return view('layouts.pages.report.banktotalcal',compact('formattedAlldebit','formattedAllcredit'));

    }


    public function lossAndProfit()
    {
        return view('layouts.pages.report.lossandprofit');
    }

    public function getLossAndProfit(Request $request)
{
    // Retrieve all transactions within the specified date range
    $getlossandprofit = Transection::whereDate('VDate', '>=', $request->startDate)
        ->whereDate('VDate', '<=', $request->endDate)
        ->get();

    // Calculate the total debit
    $totalDebit = $getlossandprofit->sum(function ($transection) {
        return floatval(str_replace(',', '', $transection->Debit));
    });

    // Calculate the total credit
    $totalCredit = $getlossandprofit->sum(function ($transection) {
        return floatval(str_replace(',', '', $transection->Credit));
    });

    // Format the totals to include commas and two decimal places
    $formattedTotalDebit = number_format($totalDebit, 2, '.', ',');
    $formattedTotalCredit = number_format($totalCredit, 2, '.', ',');


    // Pass the formatted totals to the view along with the transactions
    return view('layouts.pages.report.loadlossandprofit', compact('getlossandprofit', 'formattedTotalDebit', 'formattedTotalCredit'));
}


    public function stockReport()
    {
        $stockvalue = stockValue::with('material')->get();
        return view('layouts.pages.report.stockreport',compact('stockvalue'));
    }

    public function individualDateReportSupplier()
    {
        $allSallerName = SallerInformation::where('category',1)->get();
        return view('layouts.pages.report.individual_date_report_supplier',compact('allSallerName'));
    }

    // public function deteSupReport(Request $request)
    // {

    //     $getdetsuppReport = Purchase::with('purchaseDetails.category','purchaseDetails.material','purchaseDetails.unit')->where('supplier_id',$request->supplierid)->whereDate('order_date', $request->date)->first();
    //     dd($getdetsuppReport);
    //     $netamount = $getdetsuppReport->Total_purchase_amount || 0;


    //     $purdetails = $getdetsuppReport->purchaseDetails;

    //     $totalsub = $purdetails->sum('sub_total');


    //     $discount = $getdetsuppReport->discount || 0;


    //     return view('layouts.pages.report.loaddeteSupReport',compact('purdetails','totalsub','netamount','discount'));
    // }

    public function deteSupReport(Request $request)
{
    // Fetch the purchase report data with related details
    $getdetsuppReport = Purchase::with('purchaseDetails.category', 'purchaseDetails.material', 'purchaseDetails.unit')
        ->where('supplier_id', $request->supplierid)
        ->whereDate('order_date', $request->date)
        ->first();

    if ($getdetsuppReport) {
        $totalPurchaseAmount = floatval($getdetsuppReport->Total_purchase_amount ?? 0);
        $discount = floatval($getdetsuppReport->discount ?? 0);
        $netamount = floatval($getdetsuppReport->Total_purchase_amount ?? 0);

        $purdetails = $getdetsuppReport->purchaseDetails;


        $totalsub = $purdetails->sum('sub_total');


        return view('layouts.pages.report.loaddeteSupReport', compact('purdetails', 'totalsub', 'netamount', 'discount'));
    } else {
        // Handle the case where no data is found for the given supplier and date
        return redirect()->back()->with('error', 'No data found for the selected supplier and date.');
    }
}


    public function generateInvoice(Request $request)
    {
        $info = SallerInformation::find($request->supplierid);
        $getdetsuppReport = Purchase::with('purchaseDetails.category','purchaseDetails.material','purchaseDetails.unit')
            ->where('supplier_id', $request->supplierid)
            ->whereDate('order_date', $request->date)
            ->first();

            if ($getdetsuppReport) {
            $totalPurchaseAmount = floatval($getdetsuppReport->Total_purchase_amount ?? 0);
            $discount = floatval($getdetsuppReport->discount ?? 0);
            $netamount = floatval($getdetsuppReport->Total_purchase_amount ?? 0);

            $purdetails = $getdetsuppReport->purchaseDetails;


            $totalsub = $purdetails->sum('sub_total');


            return view('layouts.pages.report.deteSupReport', compact('purdetails', 'totalsub', 'netamount', 'discount','info'));
            } else {
                                       
            return redirect()->back()->with('error', 'No data found for the selected supplier and date.');
            }
    }


    public function toAndDateReport()
    {
        $allSallerName = SallerInformation::where('category',1)->get();
        return view('layouts.pages.report.to_and_date_report',compact('allSallerName'));
    }

    public function getSupTotaldateReport(Request $request)
    {

        $query = Purchase::with('purchaseDetails.material', 'purchaseDetails.unit');

        if ($request->has('supplierId') && !empty($request->supplierId)) {
            $query->where('supplier_id', $request->supplierId);
        }

        if ($request->has('startDate') && !empty($request->startDate) && $request->has('endDate') && !empty($request->endDate)) {
            $query->whereBetween('order_date', [$request->startDate, $request->endDate]);
        }

        $purchases = $query->get();

        $total = $purchases->flatMap->purchaseDetails->sum('sub_total');

        // $total = $purchases->flatMap->purchaseDetails->sum('sub_total');

        return view('layouts.pages.report.loadtoanddatereport', compact('purchases', 'total'));
    }

    public function getSupTotaldateInvoice(Request $request)
    {
        $info = SallerInformation::find($request->supplier_id);
        $query = Purchase::with('purchaseDetails.material', 'purchaseDetails.unit');
        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('order_date', [$request->start_date, $request->end_date]);
        }
        $purdetails = $query->get();
        $details = $purdetails->flatMap->purchaseDetails;
        $total = $details->sum('sub_total');
        return view('layouts.pages.report.loadtoanddatereportinvoice', compact('details', 'total','info'));
    }


    public function individualDateReportCus()
    {
        $allSallerName = SallerInformation::where('category',2)->get();
        return view('layouts.pages.report.individual_date_report_cus',compact('allSallerName'));
    }

    public function deteCusReport(Request $request)
    {
        $getdetcusReport = consumption::with('grade')
            ->where('customer_id', $request->customerId)
            ->whereDate('date', $request->date)
            ->get();



        return view('layouts.pages.report.loaddetecusReport', compact('getdetcusReport'));
    }

    public function generateCusInvoice(Request $request)
    {
        $info = SallerInformation::find($request->customerId);
        $getdetcusReport = consumption::with('grade','customer')
        ->where('customer_id', $request->customerId)
        ->whereDate('date', $request->date)
        ->get();


        if (!$getdetcusReport) {
            return redirect()->back()->with('error', 'No data found for the selected supplier and date.');
        }

       
        return view('layouts.pages.report.detecusReport', compact('getdetcusReport','info'));

    }




    public function toAndDateReportCus()
    {
        $allSallerName = SallerInformation::where('category',2)->get();
        return view('layouts.pages.report.to_and_date_report_cus',compact('allSallerName'));
    }

    public function getcusTotaldateReport(Request $request)
    {



        $query = consumption::with('grade');

        if ($request->has('customerId') && !empty($request->customerId)) {
            $query->where('customer_id', $request->customerId);
        }

        if ($request->has('startDate') && !empty($request->startDate) && $request->has('endDate') && !empty($request->endDate)) {
            $query->whereBetween('date', [$request->startDate, $request->endDate]);
        }

        $getcusReport = $query->get();

        return view('layouts.pages.report.loadtoanddatereportcus', compact('getcusReport'));
    }

    public function getCusTotaldateInvoice(Request $request)
    {
        $info = SallerInformation::find($request->customerId);
        $query = consumption::with('grade','customer');

        if ($request->has('customerId') && !empty($request->customerId)) {
            $query->where('customer_id', $request->customerId);
        }

        if ($request->has('startDate') && !empty($request->startDate) && $request->has('endDate') && !empty($request->endDate)) {
            $query->whereBetween('date', [$request->startDate, $request->endDate]);
        }

        $getcusReport = $query->get();

       
        return view('layouts.pages.report.loadtoanddatereportinvoicecus', compact('getcusReport', 'info'));
    }


    public function customerWiseSaleReport()
    {
        $allSallerName = SallerInformation::where('category',2)->get();
        return view('layouts.pages.report.customerwisesalereport',compact('allSallerName'));
    }

    public function getcuswisesalereport(Request $request)
    {
        $getcuswisesalereport = invoice::with('invdetail')->where('date',$request->date)->where('cus_id',$request->customerId)->get();
        $pluck = $getcuswisesalereport->pluck('id');
        $detail = invoiceDetail::with('grade','invoice')->where('inv_id',$pluck)->get();
        $totalAmount = $detail->reduce(function ($carry, $item) {
            $subTotal = floatval(str_replace(',', '', $item->sub_total));
            return $carry + $subTotal;
        }, 0);

        $formattedTotalamount = number_format($totalAmount, 2, '.', ',');
        return view('layouts.pages.report.loadcustomerwisesalereport',compact('detail','formattedTotalamount'));
    }

    public function generateSaleInvoice(Request $request)
    {
        $customer = SallerInformation::find($request->customerId);
        $getcuswisesalereport = invoice::with('invdetail')->where('date',$request->date)->where('cus_id',$request->customerId)->get();
        $pluck = $getcuswisesalereport->pluck('id');
        $detail = invoiceDetail::with('grade','invoice')->where('inv_id',$pluck)->get();
        $totalAmount = $detail->reduce(function ($carry, $item) {
            $subTotal = floatval(str_replace(',', '', $item->sub_total));
            return $carry + $subTotal;
        }, 0);

        $formattedTotalamount = number_format($totalAmount, 2, '.', ',');

        return view('layouts.pages.report.genaretecussalereport', compact('detail','formattedTotalamount','customer'));

    }










}
