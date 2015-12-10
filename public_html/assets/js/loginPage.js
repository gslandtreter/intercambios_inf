

function performLogin() {

	var metodo = ($("#submitButton").text() == "Atualizar Aluno") ? "edit" : "add";

	$.post( "performLogin.php", {
		email: $("#email").val(),
		password: $("#password").val()
	},

	function (data) {

		if(data != "OK") {
			alert(data);
			$("#password").val('');
		}
		
		else {
			window.location.href = "index.php";
		}
		
	});

	return false;
}