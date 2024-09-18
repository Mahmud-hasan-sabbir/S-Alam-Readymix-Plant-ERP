    <!--**********************************
                Sidebar start
    ***********************************-->
    <div class="deznav scrollbar">
            <div class="main-profile">
                <div class="image-bx">
                    @if (Auth::user()->role_name == "super_admin")
                    <img src="{{asset('public')}}/images/profile/{{ Auth::user()->profile_photo_path }}" alt="">

                    @elseif (Auth::user()->role_name == "admin")
                    <img src="{{asset('public')}}/images/profile/{{ Auth::user()->profile_photo_path }}" alt="">

                    @elseif (Auth::user()->role_name == "member")

                    <img src="{{ asset('/') }}/{{ Auth::user()->profile_photo_path }}" alt="">

                    @endif

                    <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
                </div>
                <h5 class="name">{{ Auth::user()->name }}</h5>
                <p class="email"><a href="mailto:<nowiki>{{ Auth::user()->email }}">[{{ Auth::user()->email }}]</a></p>
            </div>
            <ul class="metismenu" id="menu">

                <li class="nav-label first">Main Menu</li>
                <li><a href="{{route('dashboard')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-144-layout"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-149-diagram"></i>
                        <span class="nav-text">Accounts</span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text">Payment Payable</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('suppler_payment') }}">Supplier Payment</a></li>
                                <li><a href="{{ route('supplier_payment_approve_list') }}">Payment Approve </a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text">payment Receivable</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('coustomer_payment') }}">Customer Payment</a></li>
                                <li><a href="{{ route('coustomer_payment_approve_list') }}">Payment Approve </a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text">payment Refunding</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('refunding_payment') }}">Refunding Payment</a></li>
                                <li><a href="{{ route('refunding_approve_list') }}">Payment Approve </a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text">Bank-Acc-Setup</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('bank_info') }}">Bank Info</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text">Investment Or Loan</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('loan') }}">Loan</a></li>
                                <li><a href="{{ route('loan_approvelist') }}">Loan Approve</a></li>
                                <li><a href="{{ route('loan_paid_for_bank') }}">Loan paid for bank</a></li>
                                <li><a href="{{ route('loan_paid_approve') }}">Loan paid approve</a></li>

                            </ul>
                        </li>
                        <li><a href="{{ route('opening_balance') }}">Opening Balance</a></li>
                        <li><a href="{{ route('fund_transfer') }}">Fund Transfer</a></li>
                        <li><a href="{{ route('office_cash_report') }}">Office Cash Report</a></li>
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text">Expense</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('expense_head') }}">Expense Head</a></li>
                                <li><a href="{{ route('com_expense') }}">COM-Expense</a></li>
                                <li><a href="{{ route('expense_approve_list') }}">Approve Expense</a></li>

                            </ul>
                        </li>

                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-149-diagram"></i>
                        <span class="nav-text">Purchase</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('information.index',['cat_id' => 1]) }}">Active Supplier</a></li>
                        <li><a href="{{ route('inactive_supplier') }}">Inactive Supplier</a></li>
                        <li><a href="{{ route('purchase')}}">Materials Purchase</a></li>
                        <li><a href="{{ route('purchase_approve_list') }}">Approve Purchase </a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-149-diagram"></i>
                        <span class="nav-text">Invoice</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('information.index',['cat_id' => 2]) }}">Active Customer</a></li>
                        <li><a href="{{ route('inactive_customer') }}">Inactive Customer</a></li>
                        <li><a href="{{ route('add_invoice') }}">Add Invoice</a></li>
                        <li><a href="{{ route('invoice_approve_list') }}">Approve Invoice </a></li>
                        <li><a href="{{ route('consumption') }}">Consumption</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-149-diagram"></i>
                        <span class="nav-text">Salary</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('advanced_salary') }}">Advanced Salary</a></li>
                        <li><a href="{{ route('advanced_approve_salary_list') }}">Approve Advanced salary</a></li>
                        <li><a href="{{ route('pay_salary') }}">Pay salary</a></li>
                        <li><a href="{{ route('paid_approve_salary_list') }}">Approve paid salary</a></li>


                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-149-diagram"></i>
                        <span class="nav-text">ALL Report</span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="flaticon-149-diagram"></i>
                                <span class="nav-text">Purchase</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('supplier_wise_report') }}">Supplier Wise Report</a></li>
                               <li><a href="{{ route('total_supplier_report') }}">All Supplier Report</a></li>
                                <li><a href="{{ route('individual_date_report_supplier') }}">Individual date report</a></li>
                                <li><a href="{{ route('to_and_date_report') }}">Total & Date to Date Report</a></li>
                                <li><a href="{{ route('date_wise_sup_report') }}">Date wise supplir report</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="flaticon-149-diagram"></i>
                                <span class="nav-text">Sales</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('customer_wise_report') }}">Customer Wise Report</a></li>
                                <li><a href="{{ route('all_customer_report') }}">All Customer Report</a></li>
                                <li><a href="{{ route('individual_date_report_cus') }}">Individual date report</a></li>
                                <li><a href="{{ route('to_and_date_report_cus') }}">Sale Balance Sheet</a></li>
                                <li><a href="{{ route('customer_wise_sale_report') }}"> Sale Report Date wise</a></li>
                                <li><a href="{{ route('consumptionreport') }}">Consumption</a></li>

                            </ul>
                        </li>
                        <li><a href="{{ route('refunding_report') }}">Refunding Report</a></li>
                        <li><a href="{{ route('store_wise_report') }}">Store Wise Report</a></li>
                        <li><a href="{{ route('mode_wise_report') }}">Mode Wise Report</a></li>
                        <li><a href="{{ route('head_wise_report') }}">Head Wise Report</a></li>
                        <li><a href="{{ route('advanced_salary_report') }}">Advanced Salary Report</a></li>
                        <li><a href="{{ route('paid_salary_report') }}">paid salary Report</a></li>
                        <li><a href="{{ route('stock_report') }}">Stock Report</a></li>
                        <li><a href="{{ route('loss_and_profit') }}">Loss & Profit</a></li>

                    </ul>
                </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="flaticon-149-diagram"></i>
                <span class="nav-text">Data Setting</span>
            </a>
            <ul aria-expanded="false">
                <li><a href="{{ route('information.index',['cat_id' => 3]) }}">Employee</a></li>
                 <li><a href="{{ route('employee_designation') }}">Designation Manage</a></li>
                 <li><a href="{{ route('category') }}">Category Manage</a></li>
                 <li><a href="{{ route('unit') }}">Unit Manage</a></li>
                 <li><a href="{{ route('materials') }}">Materials Manage</a></li>
                 <li><a href="{{ route('store_name') }}">Store Name Manage</a></li>
                 <li><a href="{{ route('grade_name') }}">Grade Manage</a></li>
            </ul>
            </li>
            <li class="nav-label last">Main End</li>
            </ul>


            <div class="copyright">
                <div class="image-bx apps_install">
                    <a href="{{ asset('public/gulf.apk') }}"><img src="{{asset('public')}}/images/icon-android.png" style="width:60%;" alt=""></a>
                </div>
                <p><strong>S-Alam-Readymix-Plant</strong> © {{ now()->format('Y') }} All Rights Reserved</p>
                <p class="fs-12">Made with <span class="heart"></span> GoalCraftit.com</p>
            </div>
    </div>
    <!--**********************************
                Sidebar end
    ***********************************-->
