@extends('admin_master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All SubCategory</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All SubCategory</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All SubCategory</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('subcategories.create')}}" class="btn btn-primary add-new mb-2">Add New SubCategory</a>
                <div class="fetch-data table-responsive">
                    <table id="subcategory-table" class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>SubCategory Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="conts"> 
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
  
  <script>
  	$(document).ready(function(){
  		let subcategory_id;
  		var subCategoryTable = $('#subcategory-table').DataTable({
		        searching: true,
		        processing: true,
		        serverSide: true,
		        ordering: false,
		        responsive: true,
		        stateSave: true,
		        ajax: {
		          url: "{{url('/subcategories')}}",
		        },

		        columns: [
		            {data: 'subcategory_name', name: 'subcategory_name'},
                {data: 'category', name: 'category'},
		            {data: 'status', name: 'status'},
		            {data: 'action', name: 'action', orderable: false, searchable: false},
		        ]
        });



       $(document).on('click', '#status-subcategory-update', function(){

	         subcategory_id = $(this).data('id');
	         var isSubCategorychecked = $(this).prop('checked');
	         var status_val = isSubCategorychecked ? 'Active' : 'Inactive'; 
	         $.ajax({

                url: "{{url('/subcategory-status-update')}}",

                     type:"POST",
                     data:{'subcategory_id':subcategory_id, 'status':status_val},
                     dataType:"json",
                     success:function(data) {

                        toastr.success(data.message);

                        $('.data-table').DataTable().ajax.reload(null, false);

                },
	                            
	        });
       }); 


       $(document).on('click', '.delete-subcategory', function(e){

           e.preventDefault();

           subcategory_id = $(this).data('id');

           if(confirm('Do you want to delete this?'))
           {
               $.ajax({

                    url: "{{url('/subcategories')}}/"+subcategory_id,

                         type:"DELETE",
                         dataType:"json",
                         success:function(data) {

                            toastr.success(data.message);

                            $('.data-table').DataTable().ajax.reload(null, false);

                    },
                                
              });
           }

       });

  	});
  </script>

@endpush