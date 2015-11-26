
<?php


$config = include("config.php");
include("functions.php");


$auth = new Authentication();

if(!$auth->IsLoggedIn()) {
    $auth->SendToLoginPage();
}

if ($auth->GetUserPermissions($auth->GetUserName()) != "admin" && $auth->GetUserPermissions($auth->GetUserName()) != "user") {
    echo "Usuário sem permissão para efetuar a ação solicitada!";
    die();
}

$DAO = new DAO();
$DAO->Connect();

date_default_timezone_set('America/Sao_Paulo');

function addAfastamento($id_aluno, $tipo, $data_inicio, $data_fim, $programa, $universidade, $pais, $observacoes) {
    global $DAO;

    $stmt = $DAO->PrepareStatement("insert into afastamentos (id_aluno, tipo, data_inicio, data_fim, programa, universidade, pais, observacoes) values (?,?,STR_TO_DATE(?,'%d/%m/%Y'),STR_TO_DATE(?,'%d/%m/%Y'),?,?,?,?)");
    $stmt->bind_param('isssssss', $id_aluno, $tipo, $data_inicio, $data_fim, $programa, $universidade, $pais, $observacoes);
    return $DAO->ExecuteStatement($stmt);
}

function editAfastamento($id, $tipo, $data_inicio, $data_fim, $programa, $universidade, $pais, $observacoes) {
    global $DAO;

    $stmt = $DAO->PrepareStatement("update afastamentos set tipo = ?, data_inicio = STR_TO_DATE(?,'%d/%m/%Y'), data_fim = STR_TO_DATE(?,'%d/%m/%Y'), programa = ?, universidade = ?, pais = ?, observacoes = ? where id = ?");
    $stmt->bind_param('sssssssi', $tipo, $data_inicio, $data_fim, $programa, $universidade, $pais, $observacoes, $id);
    return $DAO->ExecuteStatement($stmt);
}

function removeAfastamento($id) {
    global $DAO;

    $stmt = $DAO->PrepareStatement("delete from afastamentos where id = ?");
    $stmt->bind_param('i', $id);
    return $DAO->ExecuteStatement($stmt);
}

function getNomeAluno($id_afastamento) {

    global $DAO;

    $stmt = $DAO->PrepareStatement("select nome from alunos where id_ufrgs in (select id_aluno as id_ufrgs from afastamentos where id = ?)");
    $stmt->bind_param('i', $id_afastamento);
    $DAO->ExecuteStatement($stmt);

    $stmt->bind_result($nome);
    $stmt->fetch();

    return $nome;
}

function getNomeAlunoByID($idAluno) {

    global $DAO;
    $stmt = $DAO->PrepareStatement("select nome from alunos where id_ufrgs = ?");

    $stmt->bind_param('i', $idAluno);

    $DAO->ExecuteStatement($stmt);
    $stmt->bind_result($nome);

    if($stmt->fetch()) {
        return $nome;
    }
}

//POST
if($_SERVER['REQUEST_METHOD'] == "POST") {
    //Got POST request, either add or update user

    $id_aluno = $_POST["id_aluno"];
    $tipo = $_POST["tipo"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];

    if ($id_aluno == null || $tipo == null || $data_inicio == null || $data_fim == null) {

        //TODO: Checar se data final nao é anterior a inicial.
        echo "Dados Inválidos!";
        die();
    }

    if ($_POST["method"] == "add") {
        //Adicionar Aluno

        $success = addAfastamento($_POST["id_aluno"], $_POST["tipo"], $data_inicio, $data_fim, $_POST["programa"],
            $_POST["universidade"], $_POST["pais"], $_POST["observacoes"]);

        if($success)
            echo "Afastamento Adicionado com Sucesso!";
        else
            echo "Ocorreu um erro ao adicionar o afastamento!";
    }
    else {
        //Editar usuario

        $success = editAfastamento($_POST["id"], $_POST["tipo"], $data_inicio, $data_fim, $_POST["programa"],
            $_POST["universidade"], $_POST["pais"], $_POST["observacoes"]);

        if($success)
            echo "Afastamento atualizado com Sucesso!";
        else
            echo "Ocorreu um erro ao atualizar o afastamento!";
    }

    die();
}

//GET
$method = $_GET["method"];

$afastamentoData[id] = $_GET["id_afastamento"];
$submitButtonText = null;

$nomeAluno = getNomeAluno($afastamentoData[id]);

if($method == "edit") {

    $submitButtonText = "Salvar Alterações";
    $stmt = $DAO->PrepareStatement("select id_aluno, tipo, data_inicio, data_fim, programa, universidade, pais, observacoes from afastamentos where id = ?");

    $stmt->bind_param('i', $afastamentoData[id]);

    $DAO->ExecuteStatement($stmt);

    $stmt->bind_result($afastamentoData[id_aluno], $afastamentoData[tipo], $afastamentoData[data_inicio], $afastamentoData[data_fim],
        $afastamentoData[programa], $afastamentoData[universidade], $afastamentoData[pais], $afastamentoData[observacoes]);

    $stmt->fetch();

    $afastamentoData[data_inicio] = date("d/m/Y", strtotime($afastamentoData[data_inicio]));
    $afastamentoData[data_fim] = date("d/m/Y", strtotime($afastamentoData[data_fim]));
    
}

else if($method == "add") {
    $submitButtonText = "Adicionar Afastamento";
    $nomeAluno = getNomeAlunoByID($_GET["userid"]);
    $afastamentoData[id_aluno] = $_GET["userid"];
}

else if($method == "remove") {

    if($afastamentoData[id] == null) {
        echo "Afastamento Inválido!";
        die();
    }

    $success = removeAfastamento($afastamentoData[id]);

    if($success)
        echo "Afastamento removido com sucesso!";
    else
        echo "Houve um erro ao remover o afastamento!";

    die();
}

else die();

?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SpaceLab</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Font Icons -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/simple-line-icons.css">
    <!-- CSS Animate -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Switchery -->
    <link rel="stylesheet" href="assets/plugins/switchery/switchery.min.css">
    <!-- Custom styles for this theme -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- DataTables-->
    <link rel="stylesheet" href="assets/plugins/dataTables/css/dataTables.css">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <!-- Feature detection -->
    <script src="assets/js/modernizr-2.6.2.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>



<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h3 class="panel-title">Afastamento - <?php echo $nomeAluno; ?></h3>
                <div class="actions pull-right">
                    <i class="fa fa-chevron-down"></i>
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <div class="panel-body" id="panel-body">
                <form id="userForm" class="form-horizontal form-border" role="form">
                    <div class="form-group" style="display: none">
                        <label class="col-sm-3 control-label">ID</label>
                        <div class="col-sm-6">
                            <input id="fieldID" type="text" readonly="readonly" class="form-control" value="<?php echo $afastamentoData[id]; ?>">
                        </div>
                    </div>
                    <div class="form-group" style="display: none">
                        <label class="col-sm-3 control-label">ID</label>
                        <div class="col-sm-6">
                            <input id="fieldIDAluno" type="text" readonly="readonly" class="form-control" value="<?php echo $afastamentoData[id_aluno]; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Aluno</label>
                        <div class="col-sm-6">
                            <input id="fieldNome" type="text" readonly="readonly" class="form-control" value="<?php echo $nomeAluno; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tipo de Afastamento</label>
                        <div class="col-sm-6">
                            <input id="fieldTipo" type="text" class="form-control" value="<?php echo $afastamentoData[tipo]; ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label">Data Inicio</label>
                        <div class="col-sm-6">
                            <input id="fieldDataInicio" type="text" class="form-control" value="<?php echo $afastamentoData[data_inicio]; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Data Fim</label>
                        <div class="col-sm-6">
                            <input id="fieldDataFim" type="text" class="form-control" value="<?php echo $afastamentoData[data_fim]; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Programa</label>
                        <div class="col-sm-6">
                            <input id="fieldPrograma" type="text" class="form-control" value="<?php echo $afastamentoData[programa]; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Universidade</label>
                        <div class="col-sm-6">
                            <input id="fieldUniversidade" type="text" class="form-control" value="<?php echo $afastamentoData[universidade]; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">País</label>
                        <div class="col-sm-6">
                            <input id="fieldPais" type="text" class="form-control" value="<?php echo $afastamentoData[pais]; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Observações</label>
                        <div class="col-sm-6">
                            <input id="fieldObservacoes" type="text" class="form-control" value="<?php echo $afastamentoData[observacoes]; ?>">
                        </div>
                    </div>
                    <button id="submitButton" type="submit" class="btn btn-info" onClick="updateAfastamento()"><?php echo $submitButtonText; ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--main content end-->



<!--Global JS-->
<script src="assets/js/jquery-1.10.2.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/navgoco/jquery.navgoco.min.js"></script>
<script src="assets/plugins/waypoints/waypoints.min.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>
<script src="assets/js/application.js"></script>
<!--Page Level JS -->
<script src="assets/plugins/dataTables/js/jquery.dataTables.js"></script>
<script src="assets/plugins/dataTables/js/dataTables.bootstrap.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script>
    $(document).ready(function() {
        $('#example').dataTable();

        var dpInicio = $('#fieldDataInicio').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR",
            autoclose: true
        });

        var dpFim = $('#fieldDataFim').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR",
            autoclose: true
        });

    }); 

</script>
</body>

</html>
