

function loadAlunosPage() {

	 $("#mainContent").load("alunos.php");
	 return false;
}

function loadUsersPage() {

	 $("#mainContent").load("userManagement.php");
	 return false;
}

function loadUserAddPage() {

	 $("#mainContent").load("userForm.php?method=add");
	 return false;
}

function loadAddAlunoPage() {

	 $("#mainContent").load("alunoForm.php?method=add");
	 return false;
}

function loadEditarUsuario(userID) {

	$("#mainContent").load("userForm.php?method=edit&userid=" + userID);
	return false;
}

function loadEditarAluno(userID) {

	$("#mainContent").load("alunoForm.php?method=edit&id_ufrgs=" + userID);
	return false;
}

function loadExcluirUsuario(userID) {

	$.get( "userForm.php", {
		method: "remove",
		userid: userID
	},

	function (data) {
		alert(data);
		$("#mainContent").load("userManagement.php");
	});
	return false;
}

function loadExcluirAluno(userID) {

	$.get( "alunoForm.php", {
		method: "remove",
		id_ufrgs: userID
	},

	function (data) {
		alert(data);
		$("#mainContent").load("alunos.php");
	});
	return false;
}

function updateUser() {

	$.post( "userForm.php", {
		userid: $("#fieldUserID").val(),
		username: $("#fieldUserName").val(),
		email: $("#fieldEmail").val(),
		permissions: $("#userForm input[type='radio']:checked").parent().find("label").text()
	},

	function (data) {
		alert(data);
		$("#mainContent").load("userManagement.php");
	});
}

function updateAluno() {

	var metodo = ($("#submitButton").text() == "Atualizar Aluno") ? "edit" : "add";

	$.post( "alunoForm.php", {
		id_ufrgs: $("#fieldID_UFRGS").val(),
		nome: $("#fieldNome").val(),
		curso: $("#fieldCurso").val(),
		method: metodo
	},

	function (data) {
		alert(data);
		$("#mainContent").load("alunos.php");
	});
}