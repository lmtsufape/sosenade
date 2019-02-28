@extends('layouts.default')
@section('content')
	<div class="row shadow p-3 mb-5 bg-white rounded">
		<div class="col-md-12 text-center" style="font-size: 40px">
			<h1>Simulado já atendido</h1><br>
			<a style="color:green;">{{$resultado}}</a>/<a>{{$count}}</a>	
		</div>
	</div>
@stop