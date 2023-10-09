function show_all(){
	$.ajax({
		url: 'ajax_admin.php',
		type: 'POST',
		data: {action: 'show_all'},
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
