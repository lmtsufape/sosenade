<!DOCTYPE html>
<html>
	<head>
		<!-- Os scripts js e arquivos css estão sendo importados no includes.head -->
	    @include('includes.head')
	    <title>@yield('titulo') | S.O.S Enade</title>
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
		@include('includes.footer')
	</body>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.summernote').summernote({
				height: 200,
			});
			$('.summernote_alt').summernote({
				height: 100,
			});
		});
	</script>

</html>