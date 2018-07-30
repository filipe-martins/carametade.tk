<?php

session_start();
ob_start();

/* Start session, this is necessary, it must be the first thing in the PHP document after <?php syntax ! */
// if (session_status() == PHP_SESSION_NONE)
//include_once("classes/OneFileLoginApplication.php");

//deletes cookie
setcookie("username", "", time() - 2592000, "/");
//    $_SESSION = array();    // Unset all of the session variables.
unset($_SESSION);
session_destroy();  // Destroy all session data.
//
//include_once("index.php");
header('Location: index.php');    // go to start
ob_end_flush();
