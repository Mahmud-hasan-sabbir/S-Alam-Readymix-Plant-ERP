
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                    Total Stock Report
                    </h4>
                    <div>
                        
                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                    </div>

                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="row mt-4">
                        <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th>SL.NO</th>
                                <th>Material Name</th>
                                <th>Total stock</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($stockvalue as $report)
                                   
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $report->material->name }}</td> 
                                        <td>{{ $report->cur_qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



































