<?php

if (!isset($_SESSION)) {
    session_start();
}
include_once $_SERVER["DOCUMENT_ROOT"] . "/caraMetade/header.php";

/* Start session, this is necessary, it must be the first thing in the PHP document after <?php syntax ! */

/* Require login.php to call login function */
include_once("classes/OneFileLoginApplication.php");

/* Call for login function */

if ($_COOKIE) {
    $username = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;
    $password = isset($_COOKIE['password']) ? $_COOKIE['password'] : null;
}

if (isset($_POST) && !empty($_POST['Nome']))
{
    $application->actualizaPerfil();
}
if (isset($username) || $application->getUserLoginStatus()) {
    $application->setVarsPerfil();
    include_once("views/perfilForm.php");
//    include_once("views/mainForm.php");    // If user is already logged in show prefil
} else {
    include_once("views/loginForm.php");
}
