<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                       Subsidary Ladger
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
                                    <form action="{{ route('update_subsidary') }}" method="POST" enctype="multipart/form-data"  data-parsley-validate class="form-horizontal form-label-left" >
                                        @csrf
                                        <div class="row mt-2">
                                            <label for="" class="col-md-4 ">Account type</label>
                                            <div class="col-md-8">
                                               <select name="account_type" class="form-control" id="accountType" style="border-radius: 30px">
                                                    <option value="">select a account type</option>
                                                    @foreach ($parentHead as $item)
                                                        <option value="{{ $item->id }}">{{ $item->HeadName }}</option>
                                                    @endforeach
                                               </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <label for="" class="col-md-4 ">Head Name</label>
                                            <div class="col-md-8">
                                               <select name="headName" id="allHeadName" class="form-control" style="border-radius: 30px">

                                               </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <label for="" class="col-md-4 ">Subsidary Type</label>
                                            <div class="col-md-8">
                                                <select name="sabsidarytype" id="" class="form-control" style="border-radius: 30px">
                                                    <option value="0">None</option>
                                                    <option value="2">Linked with Employee</option>
                                                    <option value="1">Linked with Member</option>
                                                    <option value="3">Linked with Supplier</option>
                                                    <option value="6">Linked with Money Lender</option>
                                               </select>
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
            url:'{{ route('get_head_name')}}',
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
                allHeadName.append('<option value="' + option.id + '">' + option.HeadName + '</option>');


                });
            }
            });
        });
</script>








