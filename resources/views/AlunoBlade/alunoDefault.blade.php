<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">

    <title></title>
</head>
<body style="background: #EEE">
<div class="container">
    <div class="row justify-content-center"><br>
    	<div class="col-sm-12"><br><br><br>
        	@yield('content')
        </div>
    </div>
    <div class="row">
	<div class="col-md-12 text-center">
		<td align="left" valign="top">	<img src="1.png" width="250px"> </td>
	</div>
	

	
</div>
</div>
<script src="{{ asset( 'js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="{{ asset( 'js/bootstrap.min.js') }}"></script>
<script src="{{ asset( 'js/jquery.mask.js') }}"></script>
<script src="{{ asset( 'js/mask.js') }}"></script>
<script src="{{ asset( 'js/popper.min.js') }}"></script>
</body>
</html>


