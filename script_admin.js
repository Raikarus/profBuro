function show_smth(act){
	$.ajax({
		url: 'ajax_admin.php',
		type: 'POST',
		data: {action: act},
		success: function(response){
			$("#response").html(response);
			$(".hide_n_seek").hide();
			$("#response").show();
		}
	});
}

let form_names = ['add_role','add_dolz','add_user','up_role','up_dolz','up_user'];
function show_form(form_name){
	$("#response").hide();
	for(let form of form_names)
	{
		if(form!=form_name)
		{
			$(`#${form}`).hide();
		}
	}
	$(`#${form_name}`).fadeToggle(100);

}

$("#dolz_id_up").change(function(){
	$("#dolz_newname").val($("#dolz_id_up option:selected").text());
});
$(document).ready(function(){
	$("#dolz_newname").val($("#dolz_id_up option:selected").text());
});
