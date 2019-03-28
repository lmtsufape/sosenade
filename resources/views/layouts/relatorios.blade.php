<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">

	    <title>@yield('titulo') | S.O.S Enade</title>
	    <link href="{{ asset('css/relatorios.css') }}" rel="stylesheet">
	</head>
	<body>
		<h1 class="text-center">@yield('titulo')</h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
			- Emitido em @yield('date')
		</h2>
		<br>
	    @yield('content')
	</body>
</html>