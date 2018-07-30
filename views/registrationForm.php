<?php  
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
            <input type="text" name="utilizador" id="username" placeholder="Utilizador" class="input form-control" autocomplete="off" required autofocus>
            <label for="email">E-mail<span class="red">*</span>:</label>
            <input type="email" name="email" id="email" placeholder="Email" class="input form-control" autocomplete="on" required><br>
            <label for="password">Password<span class="red">*</span>:</label>
            <input type="password" name="password" id="password" placeholder="Password" class="input form-control" autocomplete="off" required>
            <label for="password2">Repetir password<span class="red">*</span>:</label>
            <input type="password" name="password2" id="password2" placeholder="Repita a password" class="input form-control" autocomplete="off" required><br>
            
            <!-- If there is an error it will be shown. --> 
            <?php if(!empty($_SESSION['message'])): ?>
                <div class="alert alert-danger alert-container" id="alert">
                    <strong><center><?php echo htmlentities($_SESSION['message']) ?></center></strong>
                    <?php unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>
            <!-- If user account is created. -->
            <?php if(!empty($_SESSION['SuccessMessage'])): ?>
                <div class="alert alert-success alert-container" id="alert">
                    <strong><center><?php echo htmlentities($_SESSION['SuccessMessage']) ?></center></strong>
                    <?php unset($_SESSION['SuccessMessage']); ?>
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
