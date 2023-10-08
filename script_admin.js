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
	$(".hide_n_seek").hide();
	$("#add_role").fadeIn(100);
}
function add_dolz(){
	$("#response").html("");
	$(".hide_n_seek").hide();
	$("#add_dolz").fadeIn(100);
}
function add_user(){
	$("#response").html("");
	$(".hide_n_seek").hide();
	$("#add_user").fadeIn(100);
}