var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
$('#dp1').datepicker({
	format:'dd-mm-yyyy',
	uiLibrary: 'bootstrap4',
	minDate: today,
	maxDate: function () {
		return $('#dp2').val();
	}
});

$('#dp2').datepicker({
	format:'dd-mm-yyyy',
	uiLibrary: 'bootstrap4',
	minDate: today,
	minDate: function () {
		return $('#dp1').val();
	}
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
		$("#dp1").attr("required", "required");
		$("#dp2").attr("required", "required");
	} else if($('#toggle-btn').prop("checked") == false) {
		$("#datas").hide();
		$("#dp1").val('');
		$("#dp1").removeAttr('required');
		$("#dp2").val('');
		$("#dp2").removeAttr('required');
	}
}