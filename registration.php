<?php

ob_start();
if (!isset($_SESSION)) {
    session_start();
}
/* Start session, this is necessary, it must be the first thing in the PHP document after <?php syntax ! */

/* Require registration.php to call registration class */

/* Call for registration class */
//$registration = new UserClass();

include_once("classes/OneFileLoginApplication.php");

if (isset($_SESSION['user_is_logged_in']) && $_SESSION['user_is_logged_in'])
    include_once("views/mainForm.php");    // after register enter
else if (isset($_POST["registration"]) && $_POST["registration"] == "Registrar")
    if (!$application->doRegistration()) {
        include_once("views/registrationForm.php"); //volta p o ecra registrar
    } else {
        include_once("views/mainForm.php");    // after register enter
    }
//            $this->showPageRegistration();
//else if (isset($application) && !empty($application->getFeedback()))
////        && !(isset($_GET["action"]) && $_GET["action"] == "registrar") ) 
//    header('Location: index.php');    // go to start
else
    include_once("views/registrationForm.php"); //vai p o ecra registrar

ob_end_flush();
?>