<?php 
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

require_once("classes/OneFileLoginApplication.php");

if($application->getUserLoginStatus()){
  header('Location: index.php');    // If user is already logged in redirect back to index.php
} else {
  include("views/main.php");   // Else prompt login form
}