<?php 
ob_start();
include_once 'header.php'; 
?>

<div class="container">

    <!-- Login form -->
    <div class="loginForm">
        <form  action="login.php" name="loginform" class="form-login" method="post">
            <h3 class="cnt">Bem vindo!</h3>
            <hr class="colorgraph">
            
            <label for="username">Utilizador:</label>
            <input type="text" name="utilizador" id="username" placeholder="Utilizador" class="input form-control" autocomplete="on" required autofocus>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" class="input form-control" autocomplete="off" required>
            <div class="field-group">
            <div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
		<label for="remember-me">Lembrar-me</label>
            </div>
            <a href="forgot.php">Esqueceu a password?</a><br><br>
            
            <!-- If there is an error it will be shown. --> 
            <?php if(!empty($_SESSION['message'])): ?>
                <div class="alert alert-danger alert-container" id="alert">
                    <strong><center><?php echo htmlentities($_SESSION['message']) ?></center></strong>
                    <?php unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>
            
            <input type="submit"  name="login" value="Entrar" class="btn btn-lg btn-block submit" /> 
            
        </form>

    </div>  <!-- End Login Form-->
 
<!-- URL to registration form -->
<div class="cnt"><a href="/caraMetade/registration.php?action=registrar">Não tem conta? Crie uma</a></div>

<!-- Back to main page -->  
<div class="cnt gray"><a href="index.php">Voltar à página principal</a></div>  
  
</div>
<!-- End div -->
<?php ob_end_flush();
?>