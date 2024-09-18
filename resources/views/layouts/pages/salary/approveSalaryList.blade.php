<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Salary Approve List
                    </h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL.#</th>
                                    <th>Employee Name</th>
                                    <th>Designation</th>
                                    <th>Adv_Salary</th>
                                    <th>Month</th>
                                    <th>Mode</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advancedSalary as $item )

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->employee->company_name }}</td>
                                        <td>{{ $item->employee->desig->name }}</td>
                                        <td>{{ $item->advanced_salary }}</td>
                                        <td>{{ $item->month }}</td>
                                        <td>{{ $item->pay_mode }}</td>
                                        <td>{{ $item->date }}</td>

                                    <td>
                                        <div style="width: 100%;margin-left:-19px">
                                            <form action="{{ route('ad_salary_approve',['id' => $item->id]) }}" method="post" >
                                                <button class="btn btn-sm btn-success" style="padding: 3px">Approve</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <form action="{{ route('ad_salary_cancaled',['id' => $item->id]) }}" method="post" >
                                                <button class="btn btn-sm btn-danger" style="padding: 3px;float: left;margin-left:58px;margin-top:-27px">Delete</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <button class="btn btn-sm btn-info view"  data-id="{{ $item->id }}" style="padding: 3px;width:45px;margin-left:107px;margin-top:-48px">view</i></button>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        View Advanced Salary view
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Employee Name :</label>
                                    <div class="col-md-7">
                                        <label id="empname" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Month :</label>
                                    <div class="col-md-7">
                                        <label id="month" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Year :</label>
                                    <div class="col-md-7">
                                        <label id="year" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Advanced Salary :</label>
                                    <div class="col-md-7">
                                        <label id="ad_salary" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Date :</label>
                                    <div class="col-md-7">
                                        <label id="date" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Description :</label>
                                    <div class="col-md-7">
                                        <label id="description" style="margin-top: 7px;"></label>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>


<script>
   $(document).on('click', '.view', function() {
    var id = $(this).data('id');
    $.ajax({
        url: "{{ route('advanced_salary_view') }}",
        type: "GET",
        data: { id: id },
        success: function(data) {

            $('.bd-example-modal-lg').modal('show');
            $('#empname').text(data.empname);
            $('#month').text(data.viewadsalary.month);
            $('#year').text(data.viewadsalary.year);
            $('#ad_salary').text(data.viewadsalary.advanced_salary);
            $('#date').text(data.viewadsalary.date);
            $('#description').text(data.viewadsalary.remarks);






        }
    });
});
</script>

















