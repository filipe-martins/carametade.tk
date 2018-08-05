<?php
header("Content-Type: text/html;  charset=ISO-8859-1", true);
session_start();
include_once 'header.php';

if (isset($_GET["email"]) && isset($_GET["codigo"]) && $_GET["codigo"] !== "" ){ //caso redifinir password
    /* Require Class.php to call registration function */
    include_once("classes/OneFileLoginApplication.php");
    if ($application->verifyReset_code()) {
        include_once ($_SERVER["DOCUMENT_ROOT"] . "/caraMetade/views/passwordResetForm.php");
    } else {
        $_SESSION['message'] = "Endereço de definição de nova password inválido!";
    }
}
else if (isset($_POST["updatePassword"]) && $_POST["updatePassword"] == "Actualizar password") { //gravar nova password
    /* Require Class.php to call registration function */
    include_once("classes/OneFileLoginApplication.php");
    
    if (empty($_POST['password3']) || empty($_POST['password2'])) {
        $_SESSION['message'] = "Sem password";
    } elseif ($_POST['password3'] !== $_POST['password2']) {
        $_SESSION['message'] = "Não introduziu a mesma password nos dois campos!";
    } elseif (strlen($_POST['password3']) < 6) {
        $_SESSION['message'] = "A password tem de ter no mínimo 6 caracteres";
    }
    else    
        $application->createNewPassword(); //updates password in db
}

?><!-- If there is an error it will be shown. --> 
<?php if(!empty($_SESSION['message'])): ?>
    <div class="alert alert-danger alert-container" id="alert">
        <strong><center><?php echo htmlentities($_SESSION['message'],ENT_COMPAT,"ISO-8859-1") ?></center></strong>
        <?php unset($_SESSION['message']); ?>
    </div>
<?php endif; ?>






