<?php 
//ob_start(); // começa o buffer p evitar escrever p o ecran
//if(!isset($_SESSION)) { session_start();} 
/* Start session, this is necessary, it must be the first thing in the PHP document after <?php syntax ! */ 

/* Require login.php to call login function */

/* Call for login function */ 

//if (!empty($_POST['utilizador']) && !empty($_POST['password'])) {
//            return true;
//        } elseif (empty($_POST['user_name'])) {
//            $this->feedback = "Campo do utilizador está vazio.";
//        } elseif (empty($_POST['user_password'])) {
//            $this->feedback = "Campo da password está vazia.";
//        }
//        // default return
//        return false;

include_once("classes/OneFileLoginApplication.php");

if($application->getUserLoginStatus()){
    include("views/mainForm.php");   //  If user is already logged in redirect back to index.php
} else {
    include("index.php");    // else back to start
}
//ob_end_flush();