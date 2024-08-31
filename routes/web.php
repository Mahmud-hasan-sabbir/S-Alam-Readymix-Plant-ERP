<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Admin\BackViewController;
use App\Http\Controllers\datasetting\datasettingController;
use App\Http\Controllers\purchase\purchaseController;
use App\Http\Controllers\report\reportController;
use App\Http\Controllers\account\AccountController;
use App\Http\Controllers\invoice\invoiceController;
use App\Http\Controllers\salaryController;



Route::get('/', function () {
    return view('auth.login');
});



//==================// Location //==================//
Route::get('/location', [LocationController::class, 'index'])->name('location');
Route::get('/get-districts', [LocationController::class, 'getDistricts'])->name('get_districts');
Route::get('/get-upazila', [LocationController::class, 'getUpazilas'])->name('get_upazila');
Route::get('/get-thana', [LocationController::class, 'getThanas'])->name('get_thana');


//____________________// START \\_________________//
Route::middleware([ 'auth:sanctum','verified', config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard', [BackViewController::class, 'dashboard'])->name('dashboard')->middleware('auth');
    Route::get('/coming_soon', [BackViewController::class, 'coming_soon'])->name('coming_soon')->middleware('auth');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});


Route::group(['middleware' => ['auth']], function(){

        //COA


        //======= Saller information =========//
        // Route::get('sallerinformation',[AccountController::class,'sallerIndex'])->name('sallerinformation');


        Route::get('member_edit/{id}',[AccountController::class,'memberEdit'])->name('member_edit');
        Route::get('member_view/{id}',[AccountController::class,'memberView'])->name('member_view');
        Route::post('member_update/{id}',[AccountController::class,'memberUpdate'])->name('member_update');

        //======= member information =========//
        Route::get('memberinformation',[AccountController::class,'memberinformation'])->name('memberinformation');

        //========= data setting information ===============//
        Route::get('information/cat_id={cat_id}',[datasettingController::class,'indexInformation'])->name('information.index');
        Route::post('store_saller/{type}',[datasettingController::class,'storeSaller'])->name('store_saler');
        Route::get('employee_designation',[datasettingController::class,'employeeDesignation'])->name('employee_designation');
        Route::post('store_designation',[datasettingController::class,'storeDesignation'])->name('store_designation');
        Route::get('get-designation-edit',[datasettingController::class,'getDesignationEdit'])->name('get-designation-edit');
        Route::post('update_designation',[datasettingController::class,'updateDesignation'])->name('update_designation');
        Route::get('supplier_edit/{id}',[datasettingController::class,'supplierEdit'])->name('supplier_edit');
        Route::post('update_supplier/{id}',[datasettingController::class,'updateSupplier'])->name('update_supplier');
        Route::get('supplier_view/{id}',[datasettingController::class,'supplierView'])->name('supplier_view');
        Route::get('customer_edit/{id}',[datasettingController::class,'customerEdit'])->name('customer_edit');
        Route::post('customer_update/{id}',[datasettingController::class,'customerUpdate'])->name('customer_update');
        Route::get('customer_view/{id}',[datasettingController::class,'customerView'])->name('customer_view');

        Route::get('employee_edit/{id}',[datasettingController::class,'employeeEdit'])->name('employee_edit');
        Route::post('update_employee/{id}',[datasettingController::class,'updateEmployee'])->name('update_employee');
        Route::get('employee_view/{id}',[datasettingController::class,'employeeView'])->name('employee_view');
        Route::get('inactive_supplier',[datasettingController::class,'inactiveSupplier'])->name('inactive_supplier');
        Route::get('inactive_customer',[datasettingController::class,'inactiveCustomer'])->name('inactive_customer');


        // category route

        Route::get('category',[datasettingController::class,'category'])->name('category');
        Route::post('store_category',[datasettingController::class,'storeCategory'])->name('store_category');
        Route::get('get-category-edit',[datasettingController::class,'getCategoryEdit'])->name('get-category-edit');
        Route::post('update_category',[datasettingController::class,'updateCategory'])->name('update_category');

        // unit route

        Route::get('unit',[datasettingController::class,'unit'])->name('unit');
        Route::post('store_unit',[datasettingController::class,'storeUnit'])->name('store_unit');
        Route::get('get-unit-edit',[datasettingController::class,'getUnitEdit'])->name('get-unit-edit');
        Route::post('update_unit',[datasettingController::class,'updateUnit'])->name('update_unit');

        // store name route

        Route::get('store_name',[datasettingController::class,'storeName'])->name('store_name');
        Route::post('store_name',[datasettingController::class,'storeNamesave'])->name('store_name');
        Route::get('get-store-edit',[datasettingController::class,'getStoreEdit'])->name('get-store-edit');
        Route::post('update_store',[datasettingController::class,'updateStore'])->name('update_store');

         // grade name route

         Route::get('grade_name',[datasettingController::class,'gradeName'])->name('grade_name');
         Route::post('grade_store_name',[datasettingController::class,'gradeStoreName'])->name('grade_store_name');
         Route::get('get-grade-edit',[datasettingController::class,'getGradeEdit'])->name('get-grade-edit');
         Route::post('update_grade',[datasettingController::class,'updateGrade'])->name('update_grade');


          // Materials route

          Route::get('materials',[datasettingController::class,'materials'])->name('materials');
          Route::post('store_materials',[datasettingController::class,'storeMaterials'])->name('store_materials');
          Route::get('get-materials-edit',[datasettingController::class,'getMaterialsEdit'])->name('get-materials-edit');
          Route::post('update_materials',[datasettingController::class,'updateMaterials'])->name('update_materials');

          // Purchase route

          Route::get('/purchase',[purchaseController::class,'index'])->name('purchase');
          Route::get('/get_materials',[purchaseController::class,'getMaterials'])->name('get_materials');
          Route::post('/store_purchase',[purchaseController::class,'storePurchase'])->name('store_purchase');
          Route::get('/purchase_approve_list',[purchaseController::class,'purchaseApproveList'])->name('purchase_approve_list');
          Route::PATCH('purchase_approve/{id}', [purchaseController::class, 'purchaseApprove'])->name('purchase_approve');
          Route::PATCH('purchase_calcaled/{id}', [purchaseController::class, 'purchaseCalcaled'])->name('purchase_calcaled');
          Route::get('purchase_edit', [purchaseController::class, 'PurchaseEdit'])->name('purchase_edit');
          Route::get('purchase_view/{id}', [purchaseController::class, 'purchaseView'])->name('purchase_view');
          Route::get('purchase_approve_view', [purchaseController::class, 'purchaseApproveView'])->name('purchase_approve_view');
          Route::post('update_purchase', [purchaseController::class, 'updatePurchaseEdit'])->name('update_purchase');

          // All Report Route

          Route::get('/supplier_wise_report',[reportController::class,'supplierWiseReport'])->name('supplier_wise_report');
          Route::get('/get_supplier_wise_report',[reportController::class,'getSupplierWiseReport'])->name('get_supplier_wise_report');
          Route::get('/customer_wise_report',[reportController::class,'customerWiseReport'])->name('customer_wise_report');
          Route::get('/get_customer_wise_report',[reportController::class,'getCustomerWiseReport'])->name('get_customer_wise_report');
          Route::get('/store_wise_report',[reportController::class,'storeWiseReport'])->name('store_wise_report');
          Route::get('/get_store_wise_report',[reportController::class,'getStoreWiseReport'])->name('get_store_wise_report');
          Route::get('/mode_wise_report',[reportController::class,'modeWiseReport'])->name('mode_wise_report');
          Route::get('/get_modeWiseReport',[reportController::class,'getModeWiseReport'])->name('get_modeWiseReport');
          Route::get('/head_wise_report',[reportController::class,'headWiseReport'])->name('head_wise_report');
          Route::get('/get_head_wise_report',[reportController::class,'getHeadWiseReport'])->name('get_head_wise_report');
          Route::get('/advanced_salary_report',[reportController::class,'advancedSalaryReport'])->name('advanced_salary_report');
          Route::get('/get_advanced_salary_report',[reportController::class,'getAdvancedSalaryReport'])->name('get_advanced_salary_report');
          Route::get('/paid_salary_report',[reportController::class,'paidSalaryReport'])->name('paid_salary_report');
          Route::get('/get_paid_salary_report',[reportController::class,'getPaidSalaryReport'])->name('get_paid_salary_report');
          Route::get('/total_supplier_report',[reportController::class,'totalSupplierReport'])->name('total_supplier_report');
          Route::get('/all_customer_report',[reportController::class,'allCustomerReport'])->name('all_customer_report');
          Route::get('/office_cash_report',[reportController::class,'officeCashReport'])->name('office_cash_report');
          Route::get('/bank_total_cal/{id}',[reportController::class,'bankTotalCal'])->name('bank_total_cal');
          Route::get('/loss_and_profit',[reportController::class,'lossAndProfit'])->name('loss_and_profit');
          Route::get('/get_loss_and_profit',[reportController::class,'getLossAndProfit'])->name('get_loss_and_profit');
          Route::get('/stock_report',[reportController::class,'stockReport'])->name('stock_report');
          Route::get('/individual_date_report_supplier',[reportController::class,'individualDateReportSupplier'])->name('individual_date_report_supplier');
          Route::get('/individual_date_report_cus',[reportController::class,'individualDateReportCus'])->name('individual_date_report_cus');
          Route::get('/dete_sup_report',[reportController::class,'deteSupReport'])->name('dete_sup_report');
          Route::get('/dete_cus_report',[reportController::class,'deteCusReport'])->name('dete_cus_report');
          Route::get('/generate-invoice', [reportController::class, 'generateInvoice'])->name('generate_invoice');
          Route::get('/generate_cus_invoice', [reportController::class, 'generateCusInvoice'])->name('generate_cus_invoice');
          Route::get('/generate_sale_invoice', [reportController::class, 'generateSaleInvoice'])->name('generate_sale_invoice');
          Route::get('/to_and_date_report', [reportController::class, 'toAndDateReport'])->name('to_and_date_report');
          Route::get('/to_and_date_report_cus', [reportController::class, 'toAndDateReportCus'])->name('to_and_date_report_cus');
          Route::get('/get_sup_totaldate_report', [reportController::class, 'getSupTotaldateReport'])->name('get_sup_totaldate_report');
          Route::get('/get_cus_totaldate_report', [reportController::class, 'getcusTotaldateReport'])->name('get_cus_totaldate_report');
          Route::get('/get_sup_totaldate_invoice', [reportController::class, 'getSupTotaldateInvoice'])->name('get_sup_totaldate_invoice');
          Route::get('/get_cus_totaldate_invoice', [reportController::class, 'getCusTotaldateInvoice'])->name('get_cus_totaldate_invoice');
          Route::get('/customer_wise_sale_report', [reportController::class, 'customerWiseSaleReport'])->name('customer_wise_sale_report');
          Route::get('/getcuswisesalereport', [reportController::class, 'getcuswisesalereport'])->name('getcuswisesalereport');

          // Bank account Setup route

          Route::get('/bank_info',[AccountController::class,'bankInfo'])->name('bank_info');
          Route::post('/store_bank_info',[AccountController::class,'storeBankInfo'])->name('store_bank_info');
          Route::get('/bank_edit',[AccountController::class,'bankEdit'])->name('bank_edit');
          Route::post('/update_bank_info/{id}', [AccountController::class, 'update'])->name('update_bank_info');

           // payment payable route

           Route::get('/suppler_payment',[AccountController::class,'supplerPayment'])->name('suppler_payment');
           Route::get('/get_totalamount_sup',[AccountController::class,'getTotalamountSup'])->name('get_totalamount_sup');
           Route::get('/get_acc_no',[AccountController::class,'getAccNo'])->name('get_acc_no');
           Route::post('/store_payment_supplier',[AccountController::class,'storePaymentSupplier'])->name('store_payment_supplier');
           Route::get('/supplier_payment_edit',[AccountController::class,'supplierPaymentEdit'])->name('supplier_payment_edit');
           Route::post('/update_supplier_payment',[AccountController::class,'updateSupplierPayment'])->name('update_supplier_payment');
           Route::get('/supplier_payment_approve_list',[AccountController::class,'supplierPaymentApproveList'])->name('supplier_payment_approve_list');
           Route::PATCH('/supplier_payment_approve/{id}',[AccountController::class,'supplierPaymentApprove'])->name('supplier_payment_approve');
           Route::PATCH('/supplier_payment_cancaled/{id}',[AccountController::class,'supplierPaymentCancaled'])->name('supplier_payment_cancaled');
           Route::get('/get_currentaccount_cash',[AccountController::class,'getCurrentaccountCash'])->name('get_currentaccount_cash');
           Route::get('/get_currentaccount_bank',[AccountController::class,'getCurrentaccountBank'])->name('get_currentaccount_bank');

           // invoice all route

           Route::get('/add_invoice',[invoiceController::class,'addInvoice'])->name('add_invoice');
           Route::post('/store_invoice',[invoiceController::class,'storeInvoice'])->name('store_invoice');
           Route::get('/invoice_edit/{id}',[invoiceController::class,'invoiceEdit'])->name('invoice_edit');
           Route::post('/update_invoice/{id}',[invoiceController::class,'updateInvoice'])->name('update_invoice');
           Route::get('/invoice_view',[invoiceController::class,'invoiceView'])->name('invoice_view');
           Route::get('/invoice_approve_list',[invoiceController::class,'invoiceApproveList'])->name('invoice_approve_list');
           Route::PATCH('/invoice_approve/{id}',[invoiceController::class,'invoiceApprove'])->name('invoice_approve');
           Route::PATCH('/invoice_cancaled/{id}',[invoiceController::class,'invoiceCancaled'])->name('invoice_cancaled');

           // consumption

           Route::get('/consumption',[invoiceController::class,'consumption'])->name('consumption');
           Route::get('/consum_add/{id}',[invoiceController::class,'consumAdd'])->name('consum_add');
           Route::post('/store_consumption',[invoiceController::class,'storeConsumption'])->name('store_consumption');

           // payment receivable route

           Route::get('/coustomer_payment',[AccountController::class,'coustomerPayment'])->name('coustomer_payment');
           Route::get('/get_totalamount',[AccountController::class,'getcusTotalamount'])->name('get_totalamount');
           Route::post('/store_payment_customer',[AccountController::class,'storePaymentCustomer'])->name('store_payment_customer');
           Route::get('/customer_payment_edit',[AccountController::class,'customerPaymentEdit'])->name('customer_payment_edit');
           Route::post('/update_customer_payment',[AccountController::class,'updateCustomerPayment'])->name('update_customer_payment');
           Route::get('/coustomer_payment_approve_list',[AccountController::class,'coustomerPaymentApproveList'])->name('coustomer_payment_approve_list');
           Route::PATCH('/coustomer_payment_approve/{id}',[AccountController::class,'coustomerPaymentApprove'])->name('coustomer_payment_approve');
           Route::PATCH('/coustomer_payment_cancaled/{id}',[AccountController::class,'coustomerPaymentCancaled'])->name('coustomer_payment_cancaled');

           // opening balance

           Route::get('opening_balance',[AccountController::class,'openingBalance'])->name('opening_balance');
           Route::post('store_opening_balance',[AccountController::class,'storeOpeningBalance'])->name('store_opening_balance');


           // expense route

           Route::get('expense_head',[AccountController::class,'expenseHead'])->name('expense_head');
           Route::post('store_expense_head',[AccountController::class,'storeExpenseHead'])->name('store_expense_head');
           Route::get('get-ex-head-edit',[AccountController::class,'getExHeadedit'])->name('get-ex-head-edit');
           Route::post('update_expense_head',[AccountController::class,'updateExpenseHead'])->name('update_expense_head');
           Route::get('com_expense',[AccountController::class,'comExpense'])->name('com_expense');
           Route::post('store_co_expense',[AccountController::class,'storeCoExpense'])->name('store_co_expense');
           Route::get('expense_payment_edit',[AccountController::class,'expensePaymentEdit'])->name('expense_payment_edit');
           Route::post('update_co_expense',[AccountController::class,'updateCoExpense'])->name('update_co_expense');
           Route::get('expense_approve_list',[AccountController::class,'expenseApproveList'])->name('expense_approve_list');
           Route::get('get_coexpense_view',[AccountController::class,'getCoexpenseView'])->name('get_coexpense_view');
           Route::PATCH('expense_payment_approve/{id}',[AccountController::class,'expensePaymentApprove'])->name('expense_payment_approve');
           Route::PATCH('expense_payment_cancaled/{id}',[AccountController::class,'expensePaymentCancaled'])->name('expense_payment_cancaled');


           // salary route

              Route::get('advanced_salary',[salaryController::class,'advancedSalary'])->name('advanced_salary');
              Route::get('get_employee_salary',[salaryController::class,'getEmployeeSalary'])->name('get_employee_salary');
              Route::post('store_advanced_salary',[salaryController::class,'storeAdvancedSalary'])->name('store_advanced_salary');
              Route::get('edit_advanced_salary',[salaryController::class,'editAdvancedSalary'])->name('edit_advanced_salary');
              Route::post('update_adv_salary/{id}',[salaryController::class,'updateAdvSalary'])->name('update_adv_salary');
              Route::get('advanced_approve_salary_list',[salaryController::class,'advancedApproveSalaryList'])->name('advanced_approve_salary_list');
              Route::get('advanced_salary_view',[salaryController::class,'advancedSalaryView'])->name('advanced_salary_view');
              Route::PATCH('ad_salary_approve/{id}',[salaryController::class,'adSalaryApprove'])->name('ad_salary_approve');
              Route::PATCH('ad_salary_cancaled/{id}',[salaryController::class,'adSalaryCancaled'])->name('ad_salary_cancaled');
              Route::get('pay_salary',[salaryController::class,'paySalary'])->name('pay_salary');
              Route::get('get_adv_salary',[salaryController::class,'getAdvSalary'])->name('get_adv_salary');
              Route::post('store_paid_salary',[salaryController::class,'storePaidSalary'])->name('store_paid_salary');
              Route::get('edit_paid_salary',[salaryController::class,'editPaidSalary'])->name('edit_paid_salary');
              Route::post('update_paid_salary/{id}',[salaryController::class,'updatePaidSalary'])->name('update_paid_salary');
              Route::get('paid_approve_salary_list',[salaryController::class,'paidApproveSalaryList'])->name('paid_approve_salary_list');
              Route::PATCH('paid_salary_approve/{id}',[salaryController::class,'paidSalaryApprove'])->name('paid_salary_approve');
              Route::PATCH('paid_salary_cancaled/{id}',[salaryController::class,'paidSalaryCancaled'])->name('paid_salary_cancaled');
              Route::get('paid_salary_view',[salaryController::class,'paidSalaryView'])->name('paid_salary_view');


              //fund transfer route

              Route::get('fund_transfer',[AccountController::class,'fundtransfer'])->name('fund_transfer');
              Route::get('get_currentaccount_balance',[AccountController::class,'getCurrentaccountBalance'])->name('get_currentaccount_balance');
              Route::post('store_fund_transfer',[AccountController::class,'storeFundTransfer'])->name('store_fund_transfer');

              // loan route

              Route::get('loan',[AccountController::class,'loan'])->name('loan');
              Route::post('store_investloan',[AccountController::class,'storeInvestloan'])->name('store_investloan');
              Route::get('edit_bank_loan',[AccountController::class,'editBankLoan'])->name('edit_bank_loan');
              Route::post('update_bank_loan/{id}',[AccountController::class,'updateBankLoan'])->name('update_bank_loan');
              Route::get('loan_approvelist',[AccountController::class,'loanApprovelist'])->name('loan_approvelist');
              Route::PATCH('bankloan_approve/{id}',[AccountController::class,'bankloanApprove'])->name('bankloan_approve');
              Route::PATCH('bankloan_cancaled/{id}',[AccountController::class,'bankloanCancaled'])->name('bankloan_cancaled');
              Route::get('loan_paid_for_bank',[AccountController::class,'loanPaidForBank'])->name('loan_paid_for_bank');
              Route::get('get_bank_detail',[AccountController::class,'getBankDetail'])->name('get_bank_detail');
              Route::post('store_loan_paid',[AccountController::class,'storeLoanPaid'])->name('store_loan_paid');
              Route::get('edit_paid_bank_loan',[AccountController::class,'editPaidBankLoan'])->name('edit_paid_bank_loan');
              Route::post('update_bank_loan_paid/{id}',[AccountController::class,'updateBankLoanPaid'])->name('update_bank_loan_paid');
              Route::get('loan_paid_approve',[AccountController::class,'loanPaidApprovelist'])->name('loan_paid_approve');
              Route::PATCH('paidloan_approve/{id}',[AccountController::class,'paidloanApprove'])->name('paidloan_approve');
              Route::PATCH('paidloan_cancaled/{id}',[AccountController::class,'paidloanCancaled'])->name('paidloan_cancaled');













        // ============================ member all  payment route ================================//


        // =======================================  payment associacation for supplier  ===========================================//




























       /**______________________________________________________________________________________________
     * Account part saver project end
     * ______________________________________________________________________________________________
     */




});
/**______________________________________________________________________________________________
 * Dwonload File => PDF, EXCEL ETC
 * ______________________________________________________________________________________________
 */

/**______________________________________________________________________________________________
 * Dwonload File => PDF, EXCEL ETC
 * ______________________________________________________________________________________________
 */


//__________________________ TEST AJAX MODEL_____________________________//
// use App\Http\Controllers\TodoController;
// Route::get('/todos', [TodoController::class, 'index']);
// Route::get('todos/{todo}/edit', [TodoController::class, 'edit']);
// Route::post('todos/store', [TodoController::class, 'store']);
// Route::delete('todos/destroy/{todo}', [TodoController::class, 'destroy']);

// Route::get('get-procedure', function () {$id = 1; $post = DB::select("CALL get_users_by_id(".$id.")");dd($post);});
