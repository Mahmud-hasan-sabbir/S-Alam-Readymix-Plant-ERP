<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">Inactive Customer</h4>
                    <div>
                        <a href="{{ route('information.index',['cat_id' => 2]) }}" class="btn btn-sm btn-success">
                        <i class="fa fa-reply"></i><span class="btn-icon-add"></span>Active Customer</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display table table-hover">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Customer name</th>
                                    <th>Project name</th>
                                    <th>Mobile no</th>
                                    <th>Site location</th>
                                    <th>Status</th>
                                    <th >Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inactivecustomer as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->company_name }}</td>
                                        <td>{{ $item->project_name }}</td>
                                        <td>{{ $item->mobile_no }}</td>
                                        <td>{{ $item->Address }}</td>
                                         <td>
                                            <span class="badge light badge-danger">
                                                {{ $item->Status }}
                                            </span>
                                        </td>

                                        <td>
                                            <a href="{{ route('customer_edit',$item->id) }}" class="btn btn-primary light">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ route('customer_view',$item->id) }}" class="btn btn-success light">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
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


</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.3.0/imask.min.js"></script>




