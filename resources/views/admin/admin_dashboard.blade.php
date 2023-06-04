<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--plugins-->
	<link href="{{ asset('adminbackend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{ asset('adminbackend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('adminbackend/assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{ asset('adminbackend/assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('adminbackend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('adminbackend/assets/css/app.css')}}" rel="stylesheet">
	<link href="{{ asset('adminbackend/assets/css/icons.css')}}" rel="stylesheet">


	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

	<link href="{{ asset('adminbackend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />

	<link href="{{ asset('adminbackend/assets/plugins/input-tags/css/tagsinput.css')}} " rel="stylesheet" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

{{-- /* Option 2: Import via CSS */ --}}
{{-- @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"); --}}

	<title>Admin Dashboard</title>
</head>

<body>
	
	<div class="wrapper">

        @include('admin.body.sidebar')

		
        @include('admin.body.header')
		
		<div class="page-wrapper">

			@yield('admin')
            
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
        @include('admin.body.footer')
	</div>
	<!--end wrapper-->

	<!-- Bootstrap JS -->
	<script src="{{ asset('adminbackend/assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('adminbackend/assets/js/validate.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	  {{-- <script>
		  $(function() {
			  $(".knob").knob();
		  });
	  </script> --}}
	  {{-- <script src="{{ asset('adminbackend/assets/js/index.js') }}"></script> --}}
	  <script src="{{ asset('adminbackend/assets/js/validate.min.js') }}"></script>


	  <script src="{{ asset('adminbackend/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>

	<!--app JS-->
	<script src="{{ asset('adminbackend/assets/js/app.js') }}"></script>
	

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>

	<script>
	 @if(Session::has('message'))
	 var type = "{{ Session::get('alert-type','info') }}"
	 switch(type){
		case 'info':
		toastr.info(" {{ Session::get('message') }} ");
		break;
	
		case 'success':
		toastr.success(" {{ Session::get('message') }} ");
		break;
	
		case 'warning':
		toastr.warning(" {{ Session::get('message') }} ");
		break;
	
		case 'error':
		toastr.error(" {{ Session::get('message') }} ");
		break; 
	 }
	 @endif 
	</script>

<script src="{{ asset('adminbackend/assets/js/code.js') }}"></script>

	<script src=" {{ asset('adminbackend/assets/plugins/input-tags/js/tagsinput.js') }} "></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	
	 <script src="{{ asset('adminbackend/assets/js/code.js') }}"></script>
	
		 <script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
		</script>
		
		<script>
			tinymce.init({
			  selector: '#mytextarea'
			});
		</script>











		

</body>

</html>