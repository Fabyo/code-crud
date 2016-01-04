

function msg(mens) {
	swal({
	   title: "Deseja apagar esse usuario?",
	   text: "You will not be able to recover this imaginary file!",   
	   type: "warning",   
	   showCancelButton: true,   
	   confirmButtonColor: "#DD6B55",   
	   confirmButtonText: "Sim",
	   closeOnConfirm: false }, function(){   
	   		swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
	});
}

$(document).on('click', '.deletar', function(e) {
	e.preventDefault();		

	var id = this.getAttribute("data-id");

	swal({
	   	title: "Deseja apagar esse usuario?",
	   	type: "warning",   
	   	showCancelButton: true,   
	   	confirmButtonColor: "#DD6B55",   
	   	confirmButtonText: "Sim",
	   	closeOnConfirm: false }, function(){
			location.href = 'usuarios/deletar/' + id;
	});
	//console.log($(this).getAttribute("data-id"));
	//var tab = e.target.hash;
});
