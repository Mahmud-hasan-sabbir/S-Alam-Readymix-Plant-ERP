<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SallerInformation;
use App\Models\advancedSalary;
use Illuminate\Support\Facades\Auth;
use App\Models\Accounts\BankInfo;
use App\Models\transection;
use App\Models\paidSalary;

class salaryController extends Controller
{
    public function advancedSalary()
    {
        $employee = SallerInformation::where('category',3)->get();
        $adsalary = advancedSalary::with('employee.desig')->latest()->get();
        $allbank = BankInfo::all();
        return view('layouts.pages.salary.advancedSalary',compact('employee','adsalary','allbank'));
    }

    public function getEmployeeSalary(Request $request)
    {
        $employee = SallerInformation::
        join('designations', 'designations.id', '=', 'saller_information.designation')
        ->where('saller_information.id', $request->id)
        ->select('saller_information.salary', 'designations.name as designation_name')
        ->first();

        return response()->json($employee);
    }

    public function storeAdvancedSalary(Request $request)
    {
        // $existingRecord = advancedSalary::where('emp_id', $request->emp_id)
        // ->where('month', $request->month)
        // ->where('year', $request->year)
        // ->first();

        // if ($existingRecord) {
        //     $notification = array('messege' => 'Advanced Salary already paid for this  month!', 'alert-type' => 'error');
        //     return redirect()->back()->with($notification);
        // }

        $storeadvancedSalary = new advancedSalary();
        $storeadvancedSalary->emp_id = $request->emp_id;
        $storeadvancedSalary->month = $request->month;
        $storeadvancedSalary->year = $request->year;
        $storeadvancedSalary->pay_mode = $request->pay_mode;
        $storeadvancedSalary->bank_name = $request->bank_name;
        $storeadvancedSalary->acc_no = $request->acc_no;
        $storeadvancedSalary->advanced_salary = $request->advanced_salary;
        $storeadvancedSalary->date = $request->date;
        $storeadvancedSalary->remarks = $request->remarks;
        $storeadvancedSalary->user_id = Auth::user()->id;


        $storeadvancedSalary->save();

        $notification = array('messege' => 'Advanced Salary paid Successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    public function editAdvancedSalary(Request $request)
    {
        $editadsalary = advancedSalary::with('employee.desig')->where('id',$request->id)->first();


        if($editadsalary->pay_mode == 'Cash')
        {
            $value = transection::where('UpdateBy','Cash')->sum('Debit') - transection::where('UpdateBy','Cash')->sum('Credit');
        }else{
            $value = transection::where('StoreID',$editadsalary->bank_name)->sum('Debit') - transection::where('StoreID',$editadsalary->bank_name)->sum('Credit');
        }
        // dd($editadsalary);
        $currentSalary = $editadsalary->employee->salary;
        return response()->json([
            'editadsalary' => $editadsalary,
            'currentSalary' => $currentSalary,
            'value' => $value,
        ]);
    }

    public function updateAdvSalary(Request $request ,$id)
    {
        $updateAdvancedSalary = advancedSalary::find($id);
        $updateAdvancedSalary->advanced_salary = $request->advanced_salary;
        $updateAdvancedSalary->date = $request->date;
        $updateAdvancedSalary->remarks = $request->remarks;
        $updateAdvancedSalary->save();

        $notification = array('messege' => 'Advanced Salary Update Successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    public function advancedApproveSalaryList()
    {
        $advancedSalary = advancedSalary::with('employee')->where('status',0)->latest()->get();
        return view('layouts.pages.salary.approveSalaryList',compact('advancedSalary'));
    }

    public function advancedSalaryView(Request $request)
    {
        $viewadsalary = advancedSalary::with('employee')->where('id',$request->id)->first();
        $empname = $viewadsalary->employee->company_name;
        return response()->json([
            'viewadsalary' => $viewadsalary,
            'empname' => $empname,
        ]);
    }

    public function adSalaryApprove($id)
    {
        advancedSalary::where('id', $id)->update(['status' => 1]);
        $notification = ['messege' => 'Ad Salary Approve successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function adSalaryCancaled($id)
    {
        advancedSalary::where('id', $id)->delete();
        $notification = ['messege' => 'Ad Salary delete successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function paySalary()
    {
        $employee = SallerInformation::where('category',3)->get();
        $paidsalary = paidSalary::with('employee.desig')->latest()->get();
        $allbank = BankInfo::all();
        return view('layouts.pages.salary.paySalary',compact('employee','allbank','paidsalary'));
    }

    public function getAdvSalary(Request $request)
    {
        $getadsalary = advancedSalary::where('emp_id',$request->emp_id)->where('month',$request->month)->where('year',$request->year)->where('status',1)->sum('advanced_salary');
        return response()->json($getadsalary);
    }
    public function getPadvSalary(Request $request)
    {
        $getadsalary = advancedSalary::where('month',$request->month)->where('year',$request->year)->sum('advanced_salary');
        return response()->json($getadsalary);
    }


    public function storePaidSalary(Request $request)
    {
        $existingRecord = paidSalary::where('emp_id', $request->emp_id)
        ->where('month', $request->month)
        ->where('year', $request->year)
        ->first();

        if ($existingRecord) {
            $notification = array('messege' => 'Salary already paid for this  month!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $storePaidSalary = new paidSalary();
        $storePaidSalary->emp_id = $request->emp_id;
        $storePaidSalary->month = $request->month;
        $storePaidSalary->year = $request->year;
        $storePaidSalary->pay_mode = $request->pay_mode;
        $storePaidSalary->bank_name = $request->bank_name;
        $storePaidSalary->acc_no = $request->acc_no;
        $storePaidSalary->absence = $request->absence;
        $storePaidSalary->paid_salary = $request->paid_salary;
        $storePaidSalary->adv_salary = $request->adv_salary;
        $storePaidSalary->date = $request->date;
        $storePaidSalary->remarks = $request->remarks;
        $storePaidSalary->user_id = Auth::user()->id;
        $storePaidSalary->status = 0;
        $storePaidSalary->save();



        $notification = ['messege' => 'Paid Salary store successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function editPaidSalary(Request $request)
    {
        $editpaidsalary = paidSalary::with('employee.desig')->where('id',$request->id)->first();

        if($editpaidsalary->pay_mode == 'Cash')
        {
            $value = transection::where('UpdateBy','Cash')->sum('Debit') - transection::where('UpdateBy','Cash')->sum('Credit');
        }else{
            $value = transection::where('StoreID',$editpaidsalary->bank_name)->sum('Debit') - transection::where('StoreID',$editpaidsalary->bank_name)->sum('Credit');
        }
        // dd($editadsalary);
        $currentSalary = $editpaidsalary->employee->salary;
        return response()->json([
            'editpaidsalary' => $editpaidsalary,
            'currentSalary' => $currentSalary,
            'value' => $value,
        ]);
    }

    public function updatePaidSalary(Request $request ,$id)
    {
        $updatepaidSalary = paidSalary::find($id);
        $updatepaidSalary->paid_salary = $request->paid_salary;
        $updatepaidSalary->absence = $request->absence;
        $updatepaidSalary->date = $request->date;
        $updatepaidSalary->remarks = $request->remarks;
        $updatepaidSalary->save();

        $notification = array('messege' => 'paid Salary Update Successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function paidApproveSalaryList()
    {
        $paidSalary = paidSalary::with('employee')->where('status',0)->latest()->get();
        return view('layouts.pages.salary.paidapproveSalaryList',compact('paidSalary'));
    }

    public function paidSalaryApprove($id)
    {
        paidSalary::where('id', $id)->update(['status' => 1]);
        $notification = ['messege' => 'paid Salary Approve successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function paidSalaryCancaled($id)
    {
        paidSalary::where('id', $id)->delete();
        $notification = ['messege' => 'paid Salary delete successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function paidSalaryView(Request $request)
    {
        $viewpaidsalary = paidSalary::with('employee','bankname')->where('id',$request->id)->first();
        $empname = $viewpaidsalary->employee->company_name;
        $bankname = $viewpaidsalary->bankname->bank_name ?? 'N/A';

        return response()->json([
            'viewpaidsalary' => $viewpaidsalary,
            'empname' => $empname,
            'bankname' => $bankname,
        ]);
    }


}
