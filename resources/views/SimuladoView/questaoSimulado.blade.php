)
<form class="shadow p-3 mb-5 bg-white rounded" action= "/responder/simulado" method="post">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<input type="hidden" name="simulado_id" value="{{$simulado_id}}">
	<input type="hidden" name="questao_id" value="{{$questao['id']}}">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><b> Enunciado:</b></h2>
				<h4 class="text-center"> {!! $questao['enunciado']!!} </h4><br><br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-check">
				  <input class="form-check-input" type="radio" name="alternativa" id="radioa" value="1">
				  <label class="form-check-label" for="radioa">
				    A) {{$questao['alternativa_a']}}
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="radio" name="alternativa" id="radiob" value="2">
				  <label class="form-check-label" for="radiob">
				    B) {{$questao['alternativa_b']}}
				  </label>
				</div>
				
				<div class="form-check">
				  <input class="form-check-input" type="radio" name="alternativa" id="radioc" value="3">
				  <label class="form-check-label" for="radioc">
				    C) {{$questao['alternativa_c']}}
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="radio" name="alternativa" id="radiod" value="4">
				  <label class="form-check-label" for="radiod">
				    D) {{$questao['alternativa_d']}}
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="radio" name="alternativa" id="radioe" value="5">
				  <label class="form-check-label" for="radioe">
				    E) {{$questao['alternativa_e']}}
				  </label>
				</div><br>
				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-success pull-center">Responder</button>
				</div>
				
			
			</div>
		</div>
	</div>


</form>
