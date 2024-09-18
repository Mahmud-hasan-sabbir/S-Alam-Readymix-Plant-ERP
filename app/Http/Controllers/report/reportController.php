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
use App\Models\customerPayment;
use App\Models\refundingPayment;
use App\Models\Accounts\paymentForSupplier;
use Carbon\Carbon;



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

        if ($request->headCode == 'Cash') {
            // Initialize cumulative sum variable
            DB::statement("SET @CumulativeSum := 0;");

            // Run the main query
            $getmode = DB::select(DB::raw("
                SELECT t.id, t.VDate, t.Description, s.company_name, t.Debit, t.Credit, t.UpdateBy,
                (@CumulativeSum := @CumulativeSum + t.Debit - t.Credit) as balance
                FROM transections t
                JOIN saller_information s ON t.Member_code = s.id
                WHERE t.UpdateBy = :headCode
                AND t.VDate >= :startDate
                AND t.VDate <= :endDate
            "), [
                'headCode' => $request->headCode,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate
            ]);
        } else {
            // Initialize cumulative sum variable
            DB::statement("SET @CumulativeSum := 0;");

            // Run the main query
            $getmode = DB::select(DB::raw("
                SELECT t.id, t.VDate, t.Description, s.company_name, t.Debit, t.Credit, t.UpdateBy,
                (@CumulativeSum := @CumulativeSum + t.Debit - t.Credit) as balance
                FROM transections t
                JOIN saller_information s ON t.Member_code = s.id
                WHERE t.StoreID = :headCode
                AND t.VDate >= :startDate
                AND t.VDate <= :endDate
            "), [
                'headCode' => $request->headCode,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate
            ]);
        }

        // Calculate total debit, credit, and balance manually
        $debitSum = 0;
        $creditSum = 0;
        $totalBalance = 0;

        foreach ($getmode as $item) {
            $debitSum += $item->Debit;
            $creditSum += $item->Credit;
            $totalBalance = $item->balance;
        }

        return view('layouts.pages.report.load_mode_wise_report', compact('getmode', 'debitSum', 'creditSum', 'openBal', 'totalBalance'));
    }

    public function getModewiseInvoice(Request $request)
    {
        if($request->headCode == 'Cash')
        {
            $info = 'Cash';
        }else{
            $info = BankInfo::where('id', $request->headCode)->first();
        }
       
       
        if($request->headCode == 'Cash') {
            $openBal = DB::table('transections')
                ->selectRaw('IFNULL(SUM(IFNULL(Debit, 0)) - SUM(IFNULL(Credit, 0)), 0) as balance')
                ->where('UpdateBy', $request->headCode)
                ->whereDate('VDate', '<', $request->start_date)
                ->first();
        } else {
            $openBal = DB::table('transections')
                ->selectRaw('IFNULL(SUM(IFNULL(Debit, 0)) - SUM(IFNULL(Credit, 0)), 0) as balance')
                ->where('StoreID', $request->headCode)
                ->whereDate('VDate', '<', $request->start_date)
                ->first();
        }

        DB::statement('SET @CumulativeSum := ?', [$openBal->balance]);

        if ($request->headCode == 'Cash') {
            // Initialize cumulative sum variable
            DB::statement("SET @CumulativeSum := 0;");

            // Run the main query
            $getmode = DB::select(DB::raw("
                SELECT t.id, t.VDate, t.Description, s.company_name, t.Debit, t.Credit, t.UpdateBy,
                (@CumulativeSum := @CumulativeSum + t.Debit - t.Credit) as balance
                FROM transections t
                JOIN saller_information s ON t.Member_code = s.id
                WHERE t.UpdateBy = :headCode
                AND t.VDate >= :startDate
                AND t.VDate <= :endDate
            "), [
                'headCode' => $request->headCode,
                'startDate' => $request->start_date,
                'endDate' => $request->end_date
            ]);
        } else {
            // Initialize cumulative sum variable
            DB::statement("SET @CumulativeSum := 0;");

            // Run the main query
            $getmode = DB::select(DB::raw("
                SELECT t.id, t.VDate, t.Description, s.company_name, t.Debit, t.Credit, t.UpdateBy,
                (@CumulativeSum := @CumulativeSum + t.Debit - t.Credit) as balance
                FROM transections t
                JOIN saller_information s ON t.Member_code = s.id
                WHERE t.StoreID = :headCode
                AND t.VDate >= :startDate
                AND t.VDate <= :endDate
            "), [
                'headCode' => $request->headCode,
                'startDate' => $request->start_date,
                'endDate' => $request->end_date
            ]);
        }

        // Calculate total debit, credit, and balance manually
        $debitSum = 0;
        $creditSum = 0;
        $totalBalance = 0;

        foreach ($getmode as $item) {
            $debitSum += $item->Debit;
            $creditSum += $item->Credit;
            $totalBalance = $item->balance;
        }

        return view('layouts.pages.report.load_mode_wise_report_print', compact('getmode', 'debitSum', 'creditSum', 'openBal', 'totalBalance','info'));
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

        $query = Purchase::with('purchaseDetails.material');

        if ($request->has('startDate') && !empty($request->startDate) && $request->has('endDate') && !empty($request->endDate)) {
            $query->whereBetween('order_date', [$request->startDate, $request->endDate]);
        }

        $purchases = $query->get();

        $total = $purchases->flatMap->purchaseDetails->sum('sub_total');


        return view('layouts.pages.report.loadtoanddatereport', compact('purchases', 'total'));
    }

    public function getSupTotaldateInvoice(Request $request)
    {
        $query = Purchase::with('purchaseDetails.material');
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('order_date', [$request->start_date, $request->end_date]);
        }
        $purdetails = $query->get();
        $total = $purdetails->flatMap->purchaseDetails->sum('sub_total');
        $formdate = Carbon::parse($request->start_date)->format('m/d/Y');
        $enddate = Carbon::parse($request->end_date)->format('m/d/Y');
        return view('layouts.pages.report.loadtoanddatereportinvoice', compact('purdetails','total','formdate','enddate'));
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

        $data = DB::table('invoices')
            ->join('invoice_details', 'invoices.id', '=', 'invoice_details.inv_id')
            ->join('grades', 'grades.id', '=', 'invoice_details.grade_id')
            ->join('saller_information', 'invoices.cus_id', '=', 'saller_information.id')
            ->select('invoices.date', 'invoice_details.qty_m3','invoice_details.qty_cft','invoice_details.unit_price_cft','invoice_details.sub_total', 'saller_information.Address','grades.name as grade')
            ->whereDate('invoices.date', '>=', $request->startDate)
            ->whereDate('invoices.date', '<=', $request->endDate)
            ->where('cus_id', $request->customerId)
            ->get();


            $payments = DB::table('customer_payments')
            ->where('customer_id', $request->customerId)
            ->whereDate('pay_date', '>=', $request->startDate)
            ->whereDate('pay_date', '<=', $request->endDate)
            ->get();

            $totalpaidamount = $payments->sum('pay_amount');




            $totalsum = $data->sum(function($item) {
                return floatval(str_replace(',', '', $item->sub_total));
            });

            $formattedTotalamount = number_format($totalsum, 2, '.', ',');

            $totalsumqty = $data->sum(function($item) {
                return floatval(str_replace(',', '', $item->qty_m3));
            });

            $totalsumqty = number_format($totalsumqty, 2, '.', ',');

            $totalsumqtycft = $data->sum(function($item) {
                return floatval(str_replace(',', '', $item->qty_cft));
            });

            $totalsumqtycft = number_format($totalsumqtycft, 2, '.', ',');



        return view('layouts.pages.report.loadtoanddatereportcus', compact('data','formattedTotalamount','totalsumqty','totalsumqtycft','payments','totalpaidamount'));
    }

    public function getCusTotaldateInvoice(Request $request)
    {

        $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate = Carbon::parse($request->end_date)->format('Y-m-d');
        $info = SallerInformation::find($request->customerId);
        $data = DB::table('invoices')
        ->join('invoice_details', 'invoices.id', '=', 'invoice_details.inv_id')
        ->join('grades', 'grades.id', '=', 'invoice_details.grade_id')
        ->join('saller_information', 'invoices.cus_id', '=', 'saller_information.id')
        ->select(
            'invoices.date',
            'invoice_details.qty_m3',
            'invoice_details.qty_cft',
            'invoice_details.unit_price_cft',
            'invoice_details.sub_total',
            'saller_information.Address',
            'grades.name as grade'
        )
        ->where('invoices.cus_id', $request->customerId)
        ->whereDate('invoices.date', '>=', $startDate)
        ->whereDate('invoices.date', '<=', $endDate)
        ->get();



            $payments = DB::table('customer_payments')
            ->where('customer_id', $request->customerId)
            ->whereDate('pay_date', '>=', $startDate)
            ->whereDate('pay_date', '<=', $endDate)
            ->get();

            $totalpaidamount = $payments->sum('pay_amount');




            $totalsum = $data->sum(function($item) {
                return floatval(str_replace(',', '', $item->sub_total));
            });

            $formattedTotalamount = number_format($totalsum, 2, '.', ',');

            $totalsumqty = $data->sum(function($item) {
                return floatval(str_replace(',', '', $item->qty_m3));
            });

            $totalsumqty = number_format($totalsumqty, 2, '.', ',');

            $totalsumqtycft = $data->sum(function($item) {
                return floatval(str_replace(',', '', $item->qty_cft));
            });

            $totalsumqtycft = number_format($totalsumqtycft, 2, '.', ',');


        return view('layouts.pages.report.loadtoanddatereportinvoicecus', compact('data','formattedTotalamount','totalsumqty','totalsumqtycft','payments','totalpaidamount', 'info'));
    }


    public function customerWiseSaleReport()
    {
        return view('layouts.pages.report.customerwisesalereport');
    }

    public function getcuswisesalereport(Request $request)
    {

        $data = DB::table('invoices')
            ->join('invoice_details', 'invoices.id', '=', 'invoice_details.inv_id')
            ->join('grades', 'grades.id', '=', 'invoice_details.grade_id')
            ->join('saller_information', 'invoices.cus_id', '=', 'saller_information.id')
            ->select('invoices.date', 'invoice_details.qty_m3','invoice_details.qty_cft','invoice_details.unit_price_cft','invoice_details.sub_total', 'saller_information.company_name','grades.name as grade')
            ->whereDate('invoices.date', '>=', $request->fdate)
            ->whereDate('invoices.date', '<=', $request->edate)
            ->get();

            $totalsum = $data->sum(function($item) {
                return floatval(str_replace(',', '', $item->sub_total));
            });

            $formattedTotalamount = number_format($totalsum, 2, '.', ',');




        return view('layouts.pages.report.loadcustomerwisesalereport',compact('data','formattedTotalamount'));
    }

    public function generateSaleInvoice(Request $request)
    {
        $data = DB::table('invoices')
            ->join('invoice_details', 'invoices.id', '=', 'invoice_details.inv_id')
            ->join('grades', 'grades.id', '=', 'invoice_details.grade_id')
            ->join('saller_information', 'invoices.cus_id', '=', 'saller_information.id')
            ->select('invoices.date', 'invoice_details.qty_m3','invoice_details.qty_cft','invoice_details.unit_price_cft','invoice_details.sub_total', 'saller_information.company_name','grades.name as grade')
            ->whereDate('invoices.date', '>=', $request->fdate)
            ->whereDate('invoices.date', '<=', $request->edate)
            ->get();

            $totalsum = $data->sum(function($item) {
                return floatval(str_replace(',', '', $item->sub_total));
            });

            $formattedTotalamount = number_format($totalsum, 2, '.', ',');

            $formdate = Carbon::parse($request->fdate)->format('m/d/Y');
            $enddate = Carbon::parse($request->edate)->format('m/d/Y');

        return view('layouts.pages.report.genaretecussalereport', compact('data','formattedTotalamount','formdate','enddate'));

    }


    public function refundingReport()
    {
        $allSallerName = SallerInformation::where('category',2)->get();
        return view('layouts.pages.report.refundingreport',compact('allSallerName'));
    }

    public function getRefundingReport(Request $request)
    {

        $invoices = Invoice::where('cus_id', $request->id)->where('status', 1)->get();
        $totalPurchaseAmount = $invoices->sum(function ($invoice) {
            return floatval(str_replace(',', '', $invoice->total_amount));
        });
        $totalPaymentAmount = CustomerPayment::where('customer_id', $request->id)->sum('pay_amount');
        $totalRefundAmount = refundingPayment::where('cus_id', $request->id)->sum('pay_amount');
        $netPaymentAmount = $totalPaymentAmount - $totalRefundAmount;
        $amountDue = $totalPurchaseAmount - $netPaymentAmount;
        $advanceDue = $netPaymentAmount - $totalPurchaseAmount;
        $formattedAmountDue = number_format($amountDue, 2, '.', ',');
        $formattedAdvanceDue = number_format($advanceDue, 2, '.', ',');

        if ($amountDue < 0) {
            $formattedAmountDue .= " (ADV)";
        }

        if ($advanceDue > 0) {
            $formattedAdvanceDue .= " (ADV)";
        } else {
            $formattedAdvanceDue = number_format(0, 2, '.', ',');
        }
        $refundPaid = ($advanceDue > 0 && $advanceDue == $totalRefundAmount) ? number_format(0, 2, '.', ',') : number_format($totalRefundAmount, 2, '.', ',');
        return view('layouts.pages.report.getrefundingreport', compact('totalPurchaseAmount', 'formattedAmountDue', 'totalRefundAmount', 'formattedAdvanceDue', 'refundPaid'));
    }


    public function dateWiseSupReport()
    {
        $allSallerName = SallerInformation::where('category',1)->get();
        return view('layouts.pages.report.datewisesupreport',compact('allSallerName'));
    }

    public function getSupTotalpurReport(Request $request)
    {
        // Fetch purchases along with details and materials
        $query = Purchase::with('purchaseDetails.material');

        // Filter by supplier ID if provided
        if ($request->has('supplierId') && !empty($request->supplierId)) {
            $query->where('supplier_id', $request->supplierId);
        }

        // Filter by date range if provided
        if ($request->has('startDate') && !empty($request->startDate) && $request->has('endDate') && !empty($request->endDate)) {
            $query->whereBetween('order_date', [$request->startDate, $request->endDate]);
        }

        $purchases = $query->get();

        $totalpurchaseamount = 0;

        foreach ($purchases as $purchase) {

            $totalpurchaseamount += $purchase->purchaseDetails->sum('sub_total');
        }

        $payments = paymentForSupplier::where('supplier_id', $request->supplierId)
                    ->whereBetween('pay_date', [$request->startDate, $request->endDate])
                    ->select('pay_date', 'pay_mode', 'pay_amount')
                    ->get();

        $totalpaymentamount = $payments->sum('pay_amount');


        // Pass both purchases and grouped payments to the view
        return view('layouts.pages.report.loaddatewisereport', compact('purchases', 'payments','totalpurchaseamount','totalpaymentamount'));
    }

    public function getSupTotalInvoice(Request $request)
    {

        $info = SallerInformation::find($request->supplier_id);
        $query = Purchase::with('purchaseDetails.material');

        if ($request->has('supplierId') && !empty($request->supplierId)) {
            $query->where('supplier_id', $request->supplierId);
        }

        if ($request->has('startDate') && !empty($request->startDate) && $request->has('endDate') && !empty($request->endDate)) {
            $query->whereBetween('order_date', [$request->startDate, $request->endDate]);
        }

        $purchases = $query->get();

        $totalpurchaseamount = 0;

        foreach ($purchases as $purchase) {

            $totalpurchaseamount += $purchase->purchaseDetails->sum('sub_total');
        }

        $payments = paymentForSupplier::where('supplier_id', $request->supplier_id)
                    ->whereBetween('pay_date', [$request->start_date, $request->end_date])
                    ->select('pay_date', 'pay_mode', 'pay_amount')
                    ->get();





        $totalpaymentamount = $payments->sum('pay_amount');


        // Pass both purchases and grouped payments to the view
        return view('layouts.pages.report.invoicedatewisereport', compact('purchases', 'payments','totalpurchaseamount','totalpaymentamount','info'));
    }


    public function consumptionreport()
    {
        return view('layouts.pages.report.consumptionreport');
    }

    public function getConsumptionReport(Request $request)
    {
        $consumptions = consumption::with('grade','customer')
            ->whereDate('date', '>=', $request->startDate)
            ->whereDate('date', '<=', $request->endDate)
            ->get();

            $totalqty = $consumptions->sum('quantity');
            $totalblackstone = $consumptions->sum('black_stone');
            $mixed_builder = $consumptions->sum('mixed_builder');
            $dubai = $consumptions->sum('dubai');
            $mm10 = $consumptions->sum('mm10');
            $pcc_cement = $consumptions->sum('pcc_cement');
            $opc_cement = $consumptions->sum('opc_cement');
            $beg_cement = $consumptions->sum('beg_cement');
            $sand = $consumptions->sum('sand');
            $admixer = $consumptions->sum('admixer');
            $bricks = $consumptions->sum('bricks');

        return view('layouts.pages.report.loadconsumptionreport', compact('consumptions','totalqty','totalblackstone','mixed_builder','dubai','mm10','pcc_cement','opc_cement','beg_cement','sand','admixer','bricks'));
    }

    public function getTotalconsumptionInvoice(Request $request)
    {
        $consumptions = consumption::with('grade','customer')
            ->whereDate('date', '>=', $request->start_date)
            ->whereDate('date', '<=', $request->end_date)
            ->get();

            $totalqty = $consumptions->sum('quantity');
            $totalblackstone = $consumptions->sum('black_stone');
            $mixed_builder = $consumptions->sum('mixed_builder');
            $dubai = $consumptions->sum('dubai');
            $mm10 = $consumptions->sum('mm10');
            $pcc_cement = $consumptions->sum('pcc_cement');
            $opc_cement = $consumptions->sum('opc_cement');
            $beg_cement = $consumptions->sum('beg_cement');
            $sand = $consumptions->sum('sand');
            $admixer = $consumptions->sum('admixer');
            $bricks = $consumptions->sum('bricks');

            $startdate = $request->start_date;
            $enddate = $request->end_date;

        return view('layouts.pages.report.consumptionprint', compact('consumptions','totalqty','totalblackstone','mixed_builder','dubai','mm10','pcc_cement','opc_cement','beg_cement','sand','admixer','bricks','startdate','enddate'));
    }







}
