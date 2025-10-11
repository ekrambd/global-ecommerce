@extends('admin_master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order Lists</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Order Lists</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Lists</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
     
                <div class="fetch-data table-responsive">
                    <table id="order-table-detail" class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Time</th>
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
  		let order_id;
  		var orderTable = $('#order-table-detail').DataTable({
		        searching: true,
		        processing: true,
		        serverSide: true,
		        ordering: false,
		        responsive: true,
		        stateSave: true,
		        ajax: {
		          url: "{{url('/order-lists')}}",
		        },

		        columns: [
		            {data: 'serial', name: 'serial'},
	                {data: 'name', name: 'name'},
	                {data: 'email', name: 'email'},
	                {data: 'phone', name: 'phone'},
	                {data: 'date', name: 'date'},
	                {data: 'time', name: 'time'},
		            {data: 'status', name: 'status'},
		            {data: 'action', name: 'action', orderable: false, searchable: false},
		        ]
        });



       $(document).on('click', '#status-order-update', function(){

	         order_id = $(this).data('id');
	         
       }); 


       $(document).on('click', '.delete-order', function(e){

           e.preventDefault();

           order_id = $(this).data('id');

           if(confirm('Do you want to delete this?'))
           {
               $.ajax({

                    url: "{{url('/delete-order')}}/"+order_id,

                         type:"GET",
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