

<?php

$config = include("config.php");
include("functions.php");

$DAO = new DAO();
$DAO->Connect();

$auth = new Authentication();

if(!$auth->IsLoggedIn()) {
    $auth->SendToLoginPage();
}


function GetUserName() {

    global $DAO;

    $result = $DAO->QuerySelect("Select username from users");

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row["username"];
        }
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
    <title>Intercambios INF</title>
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
    <!-- Vector Map  -->
    <link rel="stylesheet" href="assets/plugins/jvectormap/css/jquery-jvectormap-1.2.2.css">
    <!-- ToDos  -->
    <link rel="stylesheet" href="assets/plugins/todo/css/todos.css">
    <!-- Morris  -->
    <link rel="stylesheet" href="assets/plugins/morris/css/morris.css">
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

<body class="off-canvas">
    <div id="container">
        <header id="header">
            <!--logo start-->
            <div class="brand">
                <a href="index.php" class="logo">INF</a>
            </div>
            <!--logo end-->
            <div class="toggle-navigation toggle-left">
                <button type="button" class="btn btn-default" id="toggle-left" data-toggle="tooltip" data-placement="right" title="Toggle Navigation">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="user-nav">
                <ul>
                    <li class="dropdown settings">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
                            <?php
                            global $auth;
                            echo $auth->GetUserName();
                            ?>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu animated fadeInDown">
                            <li>
                                <a href="performLogout.php"><i class="fa fa-power-off"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
        <!--sidebar left start-->
        <nav class="sidebar sidebar-left">
            <h5 class="sidebar-header">Menu</h5>
            <ul class="nav nav-pills nav-stacked">
                <li>
                    <a href="#" title="Dashboard" onclick="loadAlunosPage();">
                        <i class="fa fa-table"></i> Alunos
                    </a>
                </li>
                
                <?php
                $auth = new Authentication();
                if($auth->GetUserPermissions($auth->GetUserName()) == "admin") { ?>
                <li>
                    <a href="#" title="Gerenciar Usuarios" onclick="loadUsersPage();">
                        <i class="fa fa-users"></i> Gerenciar Usuários
                    </a>
                </li>
                <?php } ?>

                <li>
                    <a href="performLogout.php" title="Logout">
                        <i class="fa fa-power-off"></i> Logout
                    </a>
                </li>

            </ul>
        </nav>

        <!--sidebar left end-->
        <!--main content start-->
        <section class="main-content-wrapper">
            <section id="mainContent">



            </section>
        </section>
    </div>
    <!--main content end-->

    <!--Global JS-->
    <script src="assets/js/jquery-1.10.2.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/navgoco/jquery.navgoco.min.js"></script>
    <script src="assets/plugins/waypoints/waypoints.min.js"></script>
    <script src="assets/plugins/switchery/switchery.min.js"></script>
    <script src="assets/js/application.js"></script>
    <script src="assets/js/menu.js"></script>
    <!--Page Level JS-->


    <!--Load these page level functions-->
    <script>
        $(document).ready(function() {

        });
    </script>

</body>

</html>
