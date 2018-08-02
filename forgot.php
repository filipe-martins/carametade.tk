<?php
header("Content-Type: text/html;  charset=ISO-8859-1", true);
session_start();
include_once 'header.php';

if (isset($_GET["action"]) && $_GET["action"] == "entrar"){
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/caraMetade/views/forgotForm.php");
    exit();
}

/* Require Class.php to call registration function */
include_once("classes/OneFileLoginApplication.php");

if ($application->createLinkResetPassword()) {
//    include_once("views/mainForm.php");
//    include_once("views/mainForm.php");    // If user is already logged in redirect back to Main Screen
} else {
//    include_once("views/loginForm.php");
//    header('Location: views/loginForm.php');// Else prompt login form
}
?>

<!-- If there is an error it will be shown. --> 
<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-danger alert-container" id="alert">
        <strong><center><?php echo $_SESSION['message'] ?></center></strong>
        <?php unset($_SESSION['message']); ?>
    </div>
<?php endif; ?>
<!-- If e-mail has been sent. -->
<?php if (!empty($_SESSION['SuccessMessage'])): ?>
    <div class="alert alert-success alert-container" id="alert">
        <strong><center><?php echo htmlentities($_SESSION['SuccessMessage']) ?></center></strong>
        <?php unset($_SESSION['SuccessMessage']); ?>
    </div>
<?php endif; ?>

<!--codigo enviar mail testar live on server-->
<?php
//$to = "somebody@example.com";
//$subject = "My subject";
//$txt = "Hello world!";
//$headers = "From: webmaster@example.com" . "\r\n" .
//        "CC: somebodyelse@example.com";
//
//mail($to, $subject, $txt, $headers);
//?>