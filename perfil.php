<?php

if (!isset($_SESSION)) {
    session_start();
}
include_once $_SERVER["DOCUMENT_ROOT"] . "/caraMetade/header.php";

/* Start session, this is necessary, it must be the first thing in the PHP document after <?php syntax ! */

/* Require login.php to call login function */
include_once("classes/OneFileLoginApplication.php");

/* Call for login function */

//if ($_SESSION['username']) {
//    
//} else if ($_COOKIE) { //has cookie
//    $username = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;
////    $password = isset($_COOKIE['password']) ? $_COOKIE['password'] : null;
//}


if (isset($_POST) && !empty($_POST['Nome'])) { //submited form perfil
    if ($application->actualizaPerfil()) {
        include_once("index.php");    // back to start
    }
} else { //first time
    if ($_SESSION['username'] ) {
        $application->setVarsPerfil();
        include_once("views/perfilForm.php");
    } 
//    else { //n fez login //apagar??
//        include_once("views/loginForm.php");
//    }
}
