$(function() {
	$('input[name="periodo"]').daterangepicker({
		minDate: moment().startOf('hour'),
		opens: "center",
		drops: "up",
		"timePicker": true,
		"timePicker24Hour": true,
		"locale": {
			format: 'DD/MM/YYYY HH:mm',
			"separator": " - ",
			"applyLabel": "Ok",
			"cancelLabel": "Cancelar",
			"fromLabel": "De",
			"toLabel": "Até",
			"customRangeLabel": "Custom",
			"weekLabel": "S",
			"daysOfWeek": [
				"Dom",
				"Seg",
				"Ter",
				"Qua",
				"Qui",
				"Sex",
				"Sab"
			],
			"monthNames": [
				"Janeiro",
				"Fevereiro",
				"Março",
				"Abril",
				"Maio",
				"Junho",
				"Julho",
				"Agosto",
				"Setembro",
				"Outubro",
				"Novembro",
				"Dezembro"
			],
			"firstDay": 1
		},
	}, function(start, end, label) {
		console.log('Novo período selecionado: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (período predefinido: ' + label + ')');
	});
});

$( document ).ready(function() {
	hide_show_datepicker();
});

$('#toggle-btn').change(function() {
	hide_show_datepicker();
});

function hide_show_datepicker() {
	if($('#toggle-btn').prop("checked") == true){
		$("#datas").show();
		$("#periodo").attr("required", "required");
	} else if($('#toggle-btn').prop("checked") == false) {
		$("#datas").hide();
		$("#periodo").val('');
		$("#periodo").removeAttr('required');
	}
}