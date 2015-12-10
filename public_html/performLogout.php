<?php


$config = include("config.php");
include("functions.php");


$auth = new Authentication();

if($auth->IsLoggedIn()) {
    $auth->Logout();
}

$auth->SendToIndex();

?>