<?php

header("Content-Type: text/html;  charset=ISO-8859-1", true);
session_start();
include_once 'header.php';


/* Require Class.php to call registration function */
//include_once("classes/OneFileLoginApplication.php");
include_once("views/procurarForm.php"); 
exit();

//if (isset($_GET["action"]) && $_GET["action"] == "entrar"){
//    include_once ($_SERVER["DOCUMENT_ROOT"] . "/caraMetade/views/forgotForm.php");
//    exit();
//}

if (!isset($_SESSION['procuro'])) { //ir a bd buscar ultimas definicoes de pesquisa
    $application->getUserProcuroParams();
}
 else {
     //procuro=1&distrito=1&idadeInf=18&idadeSup=18
    $application->getPerfisCriterioProcura($_POST['procuro'], $_POST['distrito'], $_POST['idadeInf'], $_POST['idadeSup'] );
}

//Mulheres?gender=1&region=2&ageFrom=31&ageTo=55

?>