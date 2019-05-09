@extends('layouts.app')
@section('titulo','Importar Questão')
@section('content')
	<div class="shadow p-3 bg-white rounded" id="importar">
					<div class="list-group list-group-flush mt-3">
						

			
				<div class="form-group col-md-4">
					<label for="curso_id">Cursos:</label>
					<select id = 'parent_selection' name="curso_id" class="form-control{{ $errors->has('curso_id') ? ' is-invalid' : '' }}" required autofocus>
						@foreach ($cursos as $curso)
							<option value="{{$curso->id}}" {{old('curso') == $curso->id ? 'selected' : '' }}>
								{{$curso->curso_nome}} - {{$curso->unidade->nome}} 
							</option>
						@endforeach
					</select>
					
					@if ($errors->has('curso_id'))
						<span class = "invalid-feedback" role="alert">
							{{$errors->first('curso_id')}}
						</span>
					@endif
				</div>


				<div class="form-group col-md-4">
					<label for="disciplina_id">Disciplinas:</label>
					<select id = 'child_selection' name="disciplina_id" class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required autofocus>
						@foreach ($disciplinas as $disciplina)
							<option value="{{$disciplina->curso->id}}" {{old('disciplina') == $disciplina->id ? 'selected' : '' }}>
								{{$disciplina->nome}} - {{$disciplina->curso->curso_nome}} 
							</option>
						@endforeach
					</select>
					@if ($errors->has('disciplina_id'))
						<span class = "invalid-feedback" role="alert">
							{{$errors->first('disciplina_id')}}
						</span>
					@endif
				</div>





				</div>
	</div>

<script type="text/javascript">
	//Reference: https://jsfiddle.net/fwv18zo1/
var $select1 = $( '#parent_selection' ),
	$select2 = $( '#child_selection' ),
    $options = $select2.find( 'option' );
    
$select1.on( 'change', function() {
	$select2.html( $options.filter( '[value="' + this.value + '"]' ) );
} ).trigger( 'change' );

</script>



@stop