
<?php


$config = include("config.php");
include("functions.php");


$auth = new Authentication();

if(!$auth->IsLoggedIn()) {
    $auth->SendToLoginPage();
}

if ($auth->GetUserPermissions($auth->GetUserName()) != "admin") {
    echo "Usuário sem permissão para efetuar a ação solicitada!";
    die();
}

$DAO = new DAO();
$DAO->Connect();


function addUser($userName, $email, $permissions) {
    global $DAO;

    $stmt = $DAO->PrepareStatement("insert into users (username, email, permissions) values (?,?,?) ");
    $stmt->bind_param('sss', $userName, $email, $permissions);
    return $DAO->ExecuteStatement($stmt);
}

function editUser($userID, $userName, $email, $permissions) {
    global $DAO;

    $stmt = $DAO->PrepareStatement("update users set username = ?, email = ?, permissions = ? where id = ?");
    $stmt->bind_param('sssi', $userName, $email, $permissions, $userID);
    return $DAO->ExecuteStatement($stmt);
}

function removeUser($userID) {
    global $DAO;

    $stmt = $DAO->PrepareStatement("delete from users where id = ?");
    $stmt->bind_param('i', $userID);
    return $DAO->ExecuteStatement($stmt);
}

//POST
if($_SERVER['REQUEST_METHOD'] == "POST") {
    //Got POST request, either add or update user

    $userID = $_POST["userid"];

    if($_POST["username"] == null || $_POST["email"] == null || $_POST["permissions"] == null) {
            echo "Dados Inválidos!";
            die();
    }

    if($userID == null) {
        //Adicionar Usuario

        $success = addUser($_POST["username"], $_POST["email"], $_POST["permissions"]);

        if($success)
            echo "Usuário Adicionado com Sucesso!";
        else
            echo "Ocorreu um erro ao adicionar o usuário!";
    }
    else {
        //Editar usuario

        $success = editUser($userID, $_POST["username"], $_POST["email"], $_POST["permissions"]);

        if($success)
            echo "Usuário Atualizado com Sucesso!";
        else
            echo "Ocorreu um erro ao atualizar o usuário!";
    }

    die();
}

//GET
$method = $_GET["method"];

$userData[id] = $_GET["userid"];
$submitButtonText = null;

if($method == "edit") {

    $submitButtonText = "Atualizar Usuário";
    $stmt = $DAO->PrepareStatement("select username, email, permissions from users where id = ?");

    $stmt->bind_param('i', $userData[id]);

    $DAO->ExecuteStatement($stmt);

    $stmt->bind_result($userData[userName], $userData[email], $userData[permissions]);
    $stmt->fetch();
}

else if($method == "add") {
    $submitButtonText = "Adicionar Usuário";
}

else if($method == "remove") {

    if($userData[id] == null) {
        echo "Usuário Inválido!";
        die();
    }

    $success = removeUser($userData[id]);

    if($success)
        echo "Usuário removido com sucesso!";
    else
        echo "Houve um erro ao remover o usuário!";

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
            <h3 class="panel-title">Usuário</h3>
                <div class="actions pull-right">
                    <i class="fa fa-chevron-down"></i>
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <div class="panel-body">
                <form id="userForm" class="form-horizontal form-border" role="form">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ID</label>
                        <div class="col-sm-6">
                            <input id="fieldUserID" type="text" readonly="readonly" class="form-control" value="<?php echo $userData[id]; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-6">
                            <input id="fieldUserName" type="text" class="form-control" value="<?php echo $userData[userName]; ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label">E-Mail</label>
                        <div class="col-sm-6">
                            <input id="fieldEmail" type="text" class="form-control" value="<?php echo $userData[email]; ?>">
                        </div>
                    </div>
                    

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Permissões</label>
                        <div class="col-sm-6">
                            <div class="radio">
                                <input class="icheck" type="radio" <?php if($userData[permissions] == "admin") echo "checked" ?> name="rad1">
                                <label>admin</label>
                            </div>

                            <div class="radio">
                                <input class="icheck" type="radio" <?php if($userData[permissions] == "user") echo "checked" ?> name="rad1">
                                <label>user</label>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-info" onClick="updateUser()"> <?php echo $submitButtonText; ?> </button>
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
