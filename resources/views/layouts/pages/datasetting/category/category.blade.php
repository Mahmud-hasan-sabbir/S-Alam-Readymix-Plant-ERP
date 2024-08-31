<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Category List</h4>
                    <a href="" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Create</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL.NO</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th class="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allCategory as $item )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->status == 1 ? 'Active' : 'InActive' }}</td>
                                    <td style="width:210px;">
                                        <button type="button" class="btn btn-sm btn-success p-1 px-2 edit-data" data-id="{{ $item->id }}"><i class="fa fa-pencil"></i>Edit</button>
                                        <button type="button" class="btn btn-sm btn-info p-1 px-2 view-data"  data-id="{{ $item->id }}"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</button>
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

  <!-- create modal open -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Create Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="{{ route('store_category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row mt-2">
                             <label class="col-md-5 col-form-label">Category Name :
                                 <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                 <input type="text" required  name="name" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="" class="col-md-5 col-form-label">Remarks : </label>
                            <div class="col-md-7">
                                <textarea name="description"  cols="30" rows="2" class="form-control"></textarea>
                             </div>
                        </div>
                        <div class="row mt-2">
                            <label for="" class="col-md-5">Status:</label>
                                <div class="col-md-7">
                                <select name="status"  class="form-control">
                                        <option value="1">Active</option>
                                        <option value="2">InActive</option>
                                </select>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade bd-example" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="{{ route('update_category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="" id="hiddenId" name="hideId" style="margin-left: 35px">
                    <div class="modal-body py-2 px-4">
                        <div class="row mt-2">
                             <label class="col-md-5 col-form-label">Category Name :
                                 <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                 <input type="text" id="CategoryName" name="newName" class="form-control" >
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="" class="col-md-5 col-form-label">Remarks : </label>
                            <div class="col-md-7">
                                <textarea name="newRemarks" id="CategoryRemarks" cols="30" rows="2" class="form-control"></textarea>
                             </div>
                        </div>
                        <div class="row mt-2">
                            <label for="" class="col-md-5">Status:</label>
                                <div class="col-md-7">

                                <select name="newStatus" id="status" class="form-control">

                                </select>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade view-modal-data" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        view Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="" method="POST" enctype="multipart/form-data">

                    <div class="modal-body py-2 px-4">
                        <div class="row mt-2">
                             <label class="col-md-5 col-form-label">Category Name :
                                 <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                 <input type="text" id="CategoryviewName" selected disabled  name="name" class="form-control" >
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="" class="col-md-5 col-form-label">Remarks : </label>
                            <div class="col-md-7">
                                <textarea name="description" selected disabled id="categoryviewRemarks"  cols="30" rows="2" class="form-control"></textarea>
                             </div>
                        </div>
                        <div class="row mt-2">
                            <label for="" class="col-md-5">Status:</label>
                                <div class="col-md-7">
                                    <input type="text" id="viewstatus" class="form-control" value="" disabled>
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
$(document).ready(function () {

    $(".edit-data").click(function () {
        $('.bd-example').modal('show');
        var itemId = $(this).data('id');

        $.ajax({
            url:'{{ route('get-category-edit')}}',
            method:'GET',
            dataType:"JSON",
            data:{'id':itemId},
            success:function(response){
                console.log(response);
                $('#hiddenId').val(response.getcategory.id);
                $('#CategoryName').val(response.getcategory.name);
                $('#CategoryRemarks').val(response.getcategory.description);
                $('#status').empty();
                $('#status').append('<option value="1" ' + (response.getcategory.status == 1 ? 'selected' : '') + '>Active</option>');
                $('#status').append('<option value="2" ' + (response.getcategory.status == 2 ? 'selected' : '') + '>InActive</option>');

            }
        });


    });
});
</script>

// ============ view data show ====================//

<script>
    $(document).ready(function () {

        $(".view-data").click(function () {
            $('.view-modal-data').modal('show');
            var itemId = $(this).data('id');
            
            $.ajax({
                url:'{{ route('get-category-edit')}}',
                method:'GET',
                dataType:"JSON",
                data:{'id':itemId},
                success:function(response){
                    console.log(response);
                   
                    $('#CategoryviewName').val(response.getcategory.name);
                    $('#categoryviewRemarks').val(response.getcategory.description);
                    $('#viewstatus').val(response.getcategory.status == 1 ? 'Active' : 'Inactive');
                }
            });


        });
    });
    </script>

<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif
</script>







