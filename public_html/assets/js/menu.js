

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


function loadAfastamentos(userID) {

	$("#mainContent").load("afastamentos.php?userid=" + userID);
	return false;
}

function loadNovoAfastamentoPage(userID) {

	 $("#mainContent").load("afastamentoForm.php?method=add&userid=" + userID);
	 return false;
}

function loadDetalhesAfastamento(afastamentoID) {

	$("#mainContent").load("afastamentoForm.php?method=edit&id_afastamento=" + afastamentoID);
	return false;
}

function updateAfastamento() {

	var metodo = ($("#submitButton").text() == "Salvar Alterações") ? "edit" : "add";
	var id_aluno = $("#fieldIDAluno").val();
	var id_afastamento = $("#fieldID").val();

	$.post( "afastamentoForm.php", {
		id: id_afastamento,
		id_aluno: id_aluno,
		nome: $("#fieldNome").val(),
		tipo: $("#fieldTipo").val(),
		data_inicio: $("#fieldDataInicio").val(),
		data_fim: $("#fieldDataFim").val(),
		programa: $("#fieldPrograma").val(),
		universidade: $("#fieldUniversidade").val(),
		pais: $("#fieldPais").val(),
		observacoes: $("#fieldObservacoes").val(),
		method: metodo
	},

	function (data) {
		alert(data);
		$("#mainContent").load("afastamentos.php?userid=" + id_aluno);
	});
}

function removeAfastamento(idAfastamento, idAluno) {

	$.get( "afastamentoForm.php", {
		method: "remove",
		id_afastamento: idAfastamento
	},

	function (data) {
		alert(data);
		$("#mainContent").load("afastamentos.php?userid=" + idAluno);
	});
	return false;
}