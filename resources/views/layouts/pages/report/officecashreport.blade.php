
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                    Total Office Cash Report
                    </h4>
                    <div>

                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                    </div>

                </div>
                <!-- card body -->
                <div class="card-body">

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="row">
                                <label for="" class="col-md-6 font-weight-bold">Total Balance : </label>
                                <div class="col-md-6">
                                    <label for="" id="totalamount" class="font-weight-bold"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label for="" class="col-md-6 font-weight-bold">Total Widthrow : </label>
                                <div class="col-md-6">
                                    <label for="" id="totalwidthrow" class="font-weight-bold"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label for="" class="col-md-7 font-weight-bold">Total Current Balance : </label>
                                <div class="col-md-5">
                                    <label for="" id="totalbalance" class="font-weight-bold"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




<script>
    var alldebit = "{{ $formattedAlldebit }}";
    var allcredit = "{{ $formattedAllcredit }}";
    var amount = parseFloat(alldebit.replace(/,/g, '')) - parseFloat(allcredit.replace(/,/g, ''));

    var totalDecimal = amount.toFixed(2).split('.')[1];
    if (parseInt(totalDecimal) >= 50) {
        amount = Math.ceil(amount);
    } else {
        amount = Math.floor(amount);
    }

    var formattedAmount = amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    document.getElementById('totalamount').innerHTML = alldebit;
    document.getElementById('totalwidthrow').innerHTML = allcredit;
    document.getElementById('totalbalance').innerHTML = formattedAmount;
</script>





































