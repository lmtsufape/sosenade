function updaterangeValue(val) {
	document.getElementById('rangeValue').value=val; 
}

function add_field() {
	$('#dynamic_field').append('<tr id="row'+x+'"><td style="border: 0px; width: 1%; vertical-align:middle;"><p style="vertical-align:middle; display:inherit;" class="p">'+x+'.</p></td><td style="border: 0px"><input type="alternativa'+x+'" id="alternativa'+x+'" name="alternativa[]" placeholder="Escreva aqui a alternativa" style="width:100%" required autofocus></td><td style="border: 0px;text-align: center;"><input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="'+(x-1)+'"></td><td style="border: 0px; width: 1%"><a href="#" name="remove" id="'+x+'" class="remove_field">Remover</a></td></tr>');
}

$(document).ready(function() {
	var max_fields      = 5; //maximum input boxes allowed
	var fields_table	= $("#dynamic_field"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID
	var button_hidden	= false;
	
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			add_field();
		}
		
		if (x == max_fields){
			add_button.remove();
			button_hidden = true;
		}
	});

	$(fields_table).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault();
		var button_id = $(this).attr("id");   
		$('#row'+button_id+'').remove();
		x--;

		$(".p").each(function(i) {
			$(this).text(i+3+'.');
		});

		$(".alt_buttons").each(function(i) {
			$(this).val(i);
		});

		if(button_hidden){
			$('#btt_wrap').append('<button class="btn btn-primary add_field_button">Adicionar alternativa</button>');
			add_button      = $(".add_field_button");
			button_hidden 	= false;
			$(add_button).click(function(e){ //on add input button click
				e.preventDefault();
				if(x < max_fields){ //max input box allowed
					x++; //text box increment
					add_field();
				}
				
				if (x == max_fields){
					add_button.remove();
					button_hidden = true;
				}
			});
		}
	})
});