<?php


$config = include("config.php");
include("functions.php");


$auth = new Authentication();

if($auth->IsLoggedIn()) {
    $auth->SendToIndex();
}

$DAO = new DAO();
$DAO->Connect();


function CheckCredentials($email, $password) {

    global $DAO;

    $passwordHash = md5($password);

    $stmt = $DAO->PrepareStatement("select username from users where email = ? and password = ?");
    $stmt->bind_param('ss', $email, $passwordHash);
    $DAO->ExecuteStatement($stmt);

    $stmt->bind_result($username);

    if($stmt->fetch()) {
        //Usuario Encontrado
        return $username;
    }
    else {
        //Usuario nao encontrado
        return null;
    }
}

//POST
if($_SERVER['REQUEST_METHOD'] == "POST") {

     if($_POST["email"] == null || $_POST["password"] == null) {
            echo "Dados Inválidos!";
            die();
     }

     $userName = CheckCredentials($_POST["email"], $_POST["password"]);

     if(!is_null($userName)) {
        //Autenticacao OK
        $auth->Login($userName);

        if($auth->IsLoggedIn())
            echo "OK";

        die();
     }
     else {
        echo "Email/Senha Incorretos";
        die();
     }
}