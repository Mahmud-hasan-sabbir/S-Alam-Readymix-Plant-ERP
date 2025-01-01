<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

use App\Models\Accounts\Tbl_acc_transaction;
use App\Models\member\memberDeed;
use App\Models\SallerInformation;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Models\Accounts\tbl_coa;
use App\Models\land\DeedDetails;
use Illuminate\Support\Facades\Auth;
use App\Models\transection;
use App\Models\accounts\BankInfo;

class BackViewController extends Controller
{
    public function dashboard()
    {

        $user = Auth::user();
        // return view('dashboard');

        $totalEmployer = SallerInformation::where('Category',3)->count();

        // $bankid = BankInfo::all()->pluck('id');
        $totalSumIncome = transection::where('UpdateBy','Bank')
        ->orWhere('UpdateBy', 'Cash')
        ->get();

        $totalincome = $totalSumIncome->sum('Debit');
        $totalExpense = $totalSumIncome->sum('Credit');
        $profit = $totalincome - $totalExpense;
        $Loss = $totalExpense - $totalincome;
        if($Loss < 0){
            $Losss = 0;
        }else{
            $Losss = $Loss;
        }
         return view('dashboard',compact('totalEmployer','totalincome','totalExpense'))->with([ 'profit' => $profit ?? 0,'loss' => $Losss ?? 0]);

    }
    public function coming_soon()
    {
        return view('coming_soon');
    }
}





