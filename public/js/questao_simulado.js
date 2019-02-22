function live_search_usuarios(dados){

  	$(dados).autocomplete({
	    source: function(request, response){
	        $.ajax({
	          type: 'POST',
	          dataType: 'json',
	          url: BASE_URL + 'usuario_geral/listar_usuarios',
	          data: {'dados' : dados.value},
	          success: function(data){
            	response(data);
	          }
	        });
	  	}
    });
}