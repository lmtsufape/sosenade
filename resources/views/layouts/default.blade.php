<!DOCTYPE html>
<html>
<head>
    @include('includes.head')

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
@include('includes.footer')
</body>
</html>