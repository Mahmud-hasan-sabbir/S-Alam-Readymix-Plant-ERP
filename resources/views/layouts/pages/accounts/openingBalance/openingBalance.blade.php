<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                       Opening Balance Setup
                    </h4>
                    <a href="" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" style="">
                                <div class="form-validation">
                                    <!-- this is for validation checking message -->
                                    @if (session()->has('success'))
                                        <strong class="text-success">{{session()->get('success')}}</strong>
                                    @endif

                                    <!-- this is from -->
                                    <form action="{{ route('store_opening_balance') }}" method="POST" enctype="multipart/form-data"  data-parsley-validate class="form-horizontal form-label-left" >
                                        @csrf
                                        <div class="row mt-2">
                                            <label for="" class="col-md-4 ">Account type</label>
                                            <div class="col-md-8">
                                               <select name="account_type" class="form-control" id="accountType" style="border-radius: 30px">
                                                    <option value="" selected disabled>select a account type</option>
                                                    <option value="Cash">Cash</option>
                                                    @foreach ($allbankName as $item)
                                                        <option value="{{ $item->id }}">{{ $item->bank_name }}</option>
                                                    @endforeach
                                               </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row mt-2">
                                            <label for="" class="col-md-4 ">Opening type</label>
                                            <div class="col-md-8">
                                                <select name="opening_type" class="form-control" style="border-radius: 30px">
                                                    <option value="">select a opening type</option>
                                                    <option value="Debit">Debit</option>
                                                    <option value="Credit">Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <label for="" class="col-md-4 ">Opening Balance</label>
                                            <div class="col-md-8">
                                                <input type="text" name="opening_balance" class="form-control" style="border-radius: 30px" placeholder="enter a opening balance">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <label for="" class="col-md-4 ">Opening Date</label>
                                            <div class="col-md-8">
                                                <input type="date" name="opening_date" class="form-control" style="border-radius: 30px">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <label for="" class="col-md-4"></label>
                                            <div class="col-md-8">
                                                <div style="margin-left: 223px">
                                                    <button type="submit" class="btn btn-success btn-sm submit_btn">Save</button>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

<script>
    $(document).on('change','#accountType',function(){
        var id = $(this).val();
            $.ajax({
            url:'',
            method:'GET',
            dataType:"JSON",
            data:{'id':id},
            success:function(response){
                console.log(response);
                var headName = response.headName;
                var allHeadName = $('#allHeadName');
                allHeadName.empty();
                allHeadName.append('<option disabled>--Select--</option>');
                 $.each(headName, function(index, option) {
                allHeadName.append('<option value="' + option.HeadCode + '">' + option.HeadName + '</option>');


                });
            }
            });
        });
</script>








