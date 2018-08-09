<?php
header("Content-Type: text/html;  charset=ISO-8859-1", true);
ob_start();
include_once 'header.php';
?>

<div class="container">

    <!-- Registration form -->
    <div class="registrationForm">
        <form  action="registration.php" name="registrationform" class="form-registration" method="post">
            <h3 class="cnt">Novo utilizador</h3>
            <hr class="colorgraph">
            <label for="username">Utilizador<span class="red">*</span>:</label>
            <input type="text" name="utilizador" id="username" value="<?php echo isset($_POST['utilizador']) ? $_POST['utilizador'] : '' ?>" placeholder="Utilizador" class="input form-control" autocomplete="off" required autofocus>

            <label for="email">E-mail<span class="red">*</span>:</label>
            <input type="email" name="email" id="email"  value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="Email" class="input form-control" autocomplete="on" required><br>

            <label for="password">Password<span class="red">*</span>:</label>
            <input type="password" name="password" id="password"  value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>"placeholder="Password" class="input form-control" autocomplete="off" required>

            <label for="password2">Repetir password<span class="red">*</span>:</label>
            <input type="password" name="password2" id="password2"  value="<?php echo isset($_POST['password2']) ? $_POST['password2'] : '' ?>"placeholder="Repita a password" class="input form-control" autocomplete="off" required><br>

            <!-- If there is an error it will be shown. --> 
            <?php if (!empty($_SESSION['message'])): ?>
                <div class="alert alert-danger alert-container" id="alert">
                    <strong><center><?php echo htmlentities($_SESSION['message'],ENT_COMPAT,'ISO8859-1') ?></center>
                        <?php unset($_SESSION['message']); ?>
                    </strong>
                </div>
            <?php endif; ?>
            <!-- If user account is created. -->
            <?php if (!empty($_SESSION['SuccessMessage'])): ?>
                <div class="alert alert-success alert-container" id="alert">
                    <strong><center><?php echo htmlentities($_SESSION['SuccessMessage']) ?></center>
                        <?php unset($_SESSION['SuccessMessage']); ?>
                    </strong>
                </div>
            <?php endif; ?>

            <input type="submit"  name="registration" value="Registrar" class="btn btn-lg btn-block submit" />  

        </form>

    </div>  <!-- End registrationForm-->

    <!-- URL to login form -->
    <div class="cnt"><a href="login.php">Já tem utilizador? Entre aqui</a></div>

    <!-- Back to main page -->  
    <div class="cnt gray"><a href="index.php">Volte ao ínicio</a></div>  

</div>
<!-- End div -->
<?php ob_end_flush();
?>
