
<?php


$config = include("config.php");
include("functions.php");


$auth = new Authentication();

if(!$auth->IsLoggedIn()) {
    $auth->SendToLoginPage();
}


$DAO = new DAO();
$DAO->Connect();

date_default_timezone_set('America/Sao_Paulo');

function PrintAfastamentosTable($idAluno) {

    global $DAO;
    $stmt = $DAO->PrepareStatement("select id, tipo, data_inicio, data_fim, programa, universidade, pais, observacoes from afastamentos where id_aluno = ?");

    $stmt->bind_param('i', $idAluno);

    $DAO->ExecuteStatement($stmt);
    $stmt->bind_result($id, $tipo, $dataInicio, $dataFim, $programa, $universidade, $pais, $observacoes);

    while($stmt->fetch()) {

        echo "<tr>";
        echo "    <td>". $tipo ."</td>";
        echo "    <td>". date("d/m/Y", strtotime($dataInicio)) ."</td>";
        echo "    <td>". date("d/m/Y", strtotime($dataFim)) ."</td>";

        echo '<td><div class="btn-group">';
        echo '<button type="button" class="btn btn-primary" onclick="loadDetalhesAfastamento('. $id .')">Mais Detalhes</button>';
        echo '<button type="button" class="btn btn-danger" onclick="removeAfastamento('. $id .', ' . $idAluno . ')">Excluir</button>';
        echo '</div></td>';

        echo "</tr>";
    }
}

function PrintName($idAluno) {

    global $DAO;
    $stmt = $DAO->PrepareStatement("select nome from alunos where id_ufrgs = ?");

    $stmt->bind_param('i', $idAluno);

    $DAO->ExecuteStatement($stmt);
    $stmt->bind_result($nome);

    if($stmt->fetch()) {
        echo $nome;
    }
}


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
                <h3 class="panel-title">Afastamentos - <?php PrintName($_GET[userid]); ?></h3>
                <div class="actions pull-right">
                    <i class="fa fa-chevron-down"></i>
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Data Inicio</th>
                            <th>Data Fim</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php PrintAfastamentosTable($_GET[userid]); ?>
                    </tbody>
                </table>
                <button type="button" class="btn btn-info" onclick="loadNovoAfastamentoPage(<?php echo $_GET[userid]; ?>);">Novo Afastamento</button>
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
