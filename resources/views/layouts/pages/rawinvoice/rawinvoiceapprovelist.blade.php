<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">Raw Invoice Approve List</h4>


                </div>

                <div class="card-body" id="reload">
                    <div class="table-responsive">
                        <table id="example3" class="display">
                            <thead>
                            <tr>
                                <th>SL.No</th>
                                <th>RI-NO</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Total Sale Amount</th>
                                <th>discount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="purchase_tbody">
                                @foreach ($approveList as $key => $row)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->RI_No }}</td></td>
                                    <td>{{ date('d-m-y', strtotime($row->order_date)) }}
                                    <td>{{ $row->customer->company_name }}</td>

                                    <td>{{ number_format($row->Total_sale_amount) }}</td>
                                    <td>{{ number_format($row->discount) }}</td>
                                    <td>
                                        @if($row->is_approve == 1)
                                            <span class="badge light badge-success">Success</span>
                                        @elseif($row->is_approve == 0)
                                            <span class="badge light badge-primary">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->is_approve == 0)
                                        <button class="btn btn-info light delete" data-id="{{ $row->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        @endif
                                        <button class="btn btn-success light approve" data-id="{{ $row->id }}">
                                            <i class="fa-solid fa-thumbs-up"></i>
                                        </button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on('click', '.delete', function() {
     var id = $(this).data('id');

     Swal.fire({
         title: 'Are you sure?',
         text: "You want to delete this data!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
     }).then((result) => {
         if (result.isConfirmed) {
             $.ajax({
                 url: '{{ route('rawinvoicedelete') }}',
                 method: 'GET',
                 data: {id: id},
                 success: function(response) {
                     if (response.success) {
                         Swal.fire({
                             title: 'Deleted!',
                             text: 'Your file has been deleted.',
                             icon: 'success'
                         }).then(() => {
                             location.reload();
                         });
                     }
                 }
             });
         }
     });
 });


 </script>

<script>
   $(document).on('click', '.approve', function() {
    var id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure Approve?',
        text: "You want to approve this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Approve it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ url('rawinvoiceapprove') }}/' + id, // ID URL এ পাঠানো হচ্ছে
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'PATCH'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Approved!',
                            text: 'The invoice has been approved.',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    }
                }
            });
        }
    });
});



 </script>
