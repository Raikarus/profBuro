function show_all(){
	$.ajax({
		url: 'ajax_admin.php',
		type: 'POST',
		data: {action: 'show_all'},
		success: function(response){
			$("#response").html(response);
		}
	});
}

function add_role(){
	$("#response").html("");
	$("#add_role").fadeToggle(100);
}