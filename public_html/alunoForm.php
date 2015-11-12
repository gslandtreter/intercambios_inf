
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


function addAluno($id_ufrgs, $nome, $curso) {
    global $DAO;

    $stmt = $DAO->PrepareStatement("insert into alunos (id_ufrgs, nome, curso) values (?,?,?)");
    $stmt->bind_param('iss', $id_ufrgs, $nome, $curso);
    return $DAO->ExecuteStatement($stmt);
}

function editAluno($id_ufrgs, $nome, $curso) {
    global $DAO;

    $stmt = $DAO->PrepareStatement("update alunos set nome = ?, curso = ? where id_ufrgs = ?");
    $stmt->bind_param('ssi', $nome, $curso, $id_ufrgs);
    return $DAO->ExecuteStatement($stmt);
}

function removeAluno($id_ufrgs) {
    global $DAO;

    $stmt = $DAO->PrepareStatement("delete from alunos where id_ufrgs = ?");
    $stmt->bind_param('i', $id_ufrgs);
    return $DAO->ExecuteStatement($stmt);
}

//POST
if($_SERVER['REQUEST_METHOD'] == "POST") {
    //Got POST request, either add or update user

    $id_ufrgs = $_POST["id_ufrgs"];

    if($_POST["nome"] == null || $_POST["id_ufrgs"] == null) {
            echo "Dados Inválidos!";
            die();
    }

    if($_POST["method"] == "add") {
        //Adicionar Aluno

        $success = addAluno($_POST["id_ufrgs"], $_POST["nome"], $_POST["curso"]);

        if($success)
            echo "Aluno Adicionado com Sucesso!";
        else
            echo "Ocorreu um erro ao adicionar o aluno! Aluno já existe!";
    }
    else {
        //Editar usuario

        $success = editAluno($_POST["id_ufrgs"], $_POST["nome"], $_POST["curso"]);

        if($success)
            echo "Usuário Atualizado com Sucesso!";
        else
            echo "Ocorreu um erro ao atualizar o usuário!";
    }

    die();
}

//GET
$method = $_GET["method"];

$alunoData[id_ufrgs] = $_GET["id_ufrgs"];
$submitButtonText = null;

if($method == "edit") {

    $submitButtonText = "Atualizar Aluno";
    $stmt = $DAO->PrepareStatement("select nome, curso from alunos where id_ufrgs = ?");

    $stmt->bind_param('i', $alunoData[id_ufrgs]);

    $DAO->ExecuteStatement($stmt);

    $stmt->bind_result($alunoData[nome], $alunoData[curso]);
    $stmt->fetch();
}

else if($method == "add") {
    $submitButtonText = "Adicionar Aluno";
}

else if($method == "remove") {

    if($alunoData[id_ufrgs] == null) {
        echo "Aluno Inválido!";
        die();
    }

    $success = removeAluno($alunoData[id_ufrgs]);

    if($success)
        echo "Aluno removido com sucesso!";
    else
        echo "Houve um erro ao remover o aluno!";

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
            <h3 class="panel-title">Aluno</h3>
                <div class="actions pull-right">
                    <i class="fa fa-chevron-down"></i>
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <div class="panel-body">
                <form id="userForm" class="form-horizontal form-border" role="form">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Cartão UFRGS</label>
                        <div class="col-sm-6">
                            <input id="fieldID_UFRGS" type="text" <?php if($method == "edit") echo 'readonly="readonly"'; ?> class="form-control" value="<?php echo $alunoData[id_ufrgs]; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nome</label>
                        <div class="col-sm-6">
                            <input id="fieldNome" type="text" class="form-control" value="<?php echo $alunoData[nome]; ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label">Curso</label>
                        <div class="col-sm-6">
                            <input id="fieldCurso" type="text" class="form-control" value="<?php echo $alunoData[curso]; ?>">
                        </div>
                    </div>
                
                    <button id="submitButton" type="submit" class="btn btn-info" onClick="updateAluno()"><?php echo $submitButtonText; ?></button>
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
<!--Page Leve JS -->
<script src="assets/plugins/dataTables/js/jquery.dataTables.js"></script>
<script src="assets/plugins/dataTables/js/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function() {
        $('#example').dataTable();


    });


    

</script>
</body>

</html>
