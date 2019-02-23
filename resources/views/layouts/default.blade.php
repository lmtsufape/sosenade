<!DOCTYPE html>
<html>
	<head>
	    @include('includes.head')
	    
	    <!-- include bootstrap css/js -->
		<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script> 
		<script type="text/javascript" src="{{ asset('sn_editor/bootstrap.min.js') }}"></script>
		<link rel="stylesheet" href="{{ asset('sn_editor/bootstrap.min.css') }}" />
		
		<!-- include summernote css/js -->
		<link rel="stylesheet" type="text/css" href="{{ asset('sn_editor/summernote.css') }}">
		<script src="{{ asset('sn_editor/summernote.js') }}"></script>

	    <title></title>
	</head>

	<body style="background: #EEE">
		@include('includes.header')	
		<div class="container">
		    <div class="row justify-content-center"><br>
		    	<div class="col-sm-12"><br><br><br>
		        	@yield('content')
		        </div>
		    </div>
		</div>
	</body>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.summernote').summernote({
				height: 300,
			});
		});
	</script>

</html>