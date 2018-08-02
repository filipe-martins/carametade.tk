<?php
session_start();
include_once 'header.php';

if (isset($_GET["email"]) && isset($_GET["codigo"])){ //caso redifinir password
    /* Require Class.php to call registration function */
    include_once("classes/OneFileLoginApplication.php");
    if ($application->verifyReset_code()) {
        include_once ($_SERVER["DOCUMENT_ROOT"] . "/caraMetade/views/passwordResetForm.php");
    } else {
        exit();
    }
    
}

?><!-- If there is an error it will be shown. --> 
<?php if(!empty($_SESSION['message'])): ?>
    <div class="alert alert-danger alert-container" id="alert">
        <strong><center><?php echo htmlentities($_SESSION['message']) ?></center></strong>
        <?php unset($_SESSION['message']); ?>
    </div>
<?php endif; ?>






