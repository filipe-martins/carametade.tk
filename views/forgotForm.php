<?php
header("Content-Type: text/html;  charset=ISO-8859-1", true);
//session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/caraMetade/header.php");

/* Require Class.php to call registration function */
include_once($_SERVER["DOCUMENT_ROOT"] . "/caraMetade/classes/OneFileLoginApplication.php");
?>

<div class="container">

    <!-- Forgot password form -->
    <div class="forgotpassword-Form">
        <form action="/caraMetade/forgot.php" name="forgotpassword-Form" class="form-forgot" method="post">
            <h3 class="cnt">Forgot your password?</h3>
            <hr class="colorgraph">

            <p class="">Introduza o seu email. Iremos enviar instruções para escolher uma nova password.</p>

            <label for="email">E-mail<span class="red">*</span>:</label>
            <input type="email" name="email" id="email" placeholder="E-mail" class="input form-control" autocomplete="off" required autofocus><br>

            <!-- If there is an error it will be shown. --> 
            <?php if (!empty($_SESSION['message'])): ?>
                <div class="alert alert-danger alert-container" id="alert">
                    <strong><center><?php echo htmlentities($_SESSION['message']) ?></center></strong>
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

            <input type="submit"  name="forgotPassword" value="Send e-mail" class="btn btn-lg btn-block submit" /> 
        </form>
    </div>  <!-- End Forgot password Form-->
</div>  

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