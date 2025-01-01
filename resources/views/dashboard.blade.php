<x-app-layout>


  
    <div class="row">
        <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-danger">
				<div class="card-body  p-4">
					<div class="media">
						<span class="mr-3">
							<i class="flaticon-381-calendar-1"></i>
						</span>
						<div class="media-body text-white text-right">
							<p class="mb-1">Total Employer</p>
							<h3 class="text-white">{{ $totalEmployer }}</h3>
						</div>
					</div>
				</div>
			</div>
        </div>

        <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-success">
				<div class="card-body p-4">
					<div class="media">
						<span class="mr-3">
							<i class="flaticon-381-diamond"></i>
						</span>
						<div class="media-body text-white text-right">
							<p class="mb-1">Total Income</p>
							<h3 class="text-white">{{ $totalincome }}</h3>
						</div>
					</div>
				</div>
			</div>
        </div>
        <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-info">
				<div class="card-body p-4">
					<div class="media">
						<span class="mr-3">
							<i class="flaticon-381-heart"></i>
						</span>
						<div class="media-body text-white text-right">
							<p class="mb-1">Total Expense</p>
							<h3 class="text-white">{{ $totalExpense }}</h3>
						</div>
					</div>
				</div>
			</div>
        </div>
        <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-primary">
				<div class="card-body  p-4">
					<div class="media">
						<span class="mr-3">
							<i class="la la-users"></i>
						</span>
						<div class="media-body text-white">
							<p class="mb-1">Profit</p>
							<h3 class="text-white">{{ $profit }}</h3>


						</div>
					</div>
				</div>
			</div>
        </div>
        <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-success">
				<div class="card-body  p-4">
					<div class="media">
						<span class="mr-3">
							<i class="la la-users"></i>
						</span>
						<div class="media-body text-white">
							<p class="mb-1">Loss</p>
							<h3 class="text-white">{{ $loss }}</h3>


						</div>
					</div>
				</div>
			</div>
        </div>
       

	</div>

    {{-- <div class="row">
        <div class="col">
          <div class="collapse multi-collapse" id="multiCollapseExample1" style="width: 33%;float:inline-end">
            <div class="card card-body">
                <div>
                    <label for="">Total Land Purchase Area  : {{ $totalLandArea }} </label>
                </div>
                <div>
                    <label for="">Total Land Sale Area : {{ $totalSaleArea }} </label>
                </div>
                <div>
                    <label for="">Total vacent Land : {{ $totalvacantArea }} </label>
                </div>
                <div>
                    <label for="">Total No Of Flot :  {{ $totalNoOfflot }} </label>
                </div>
                <div>
                    <label for="">Total No Of Member : {{ $totalNoOfMember }} </label>
                </div>


            </div>
          </div> --}}
          <div class="col-md-8">
            <div class="row" style="display: none">
                <div class="col-md-10">
                    <div class="row">
                        <label for="" class="col-md-3">Member Name</label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                  <select class="mySelect for dropdwon_select " id="memberId" multiple="multiple" style="width: 100%">
                                    {{-- @foreach ($allMember as $item)
                                        <option value="{{ $item->id }}">{{ $item->Saller_name }}</option>

                                    @endforeach --}}
                                  </select>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" id="search">Search</button>
                </div>

            </div>

            <div class="row mt-4">
                <table class="table" id="data-table">
                    <thead class="thead-dark"  style="display: none">
                      <tr>

                        <th >Land Name</th>
                        <th >float area</th>
                        <th >total float amount</th>

                      </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                  </table>
            </div>
        </div>
        </div>
      </div>

     
     






</x-app-layout>



<script>
var placeholder = "select member";
$(".mySelect").select2({
    placeholder: placeholder,
});

</script>

{{-- <script>
    $(document).on('click', '#search', function(){
        var members = $('#memberId').val();

        $.ajax({
            url: "{{ route('load_member_land_details') }}",
            method: 'GET',
            dataType: 'html',
            data: {
                member: members
            },
            success: function(data){
                console.log(data);
                $('#data-table thead').show();
                $('#tbody').html(data);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
</script> --}}
