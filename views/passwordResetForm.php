<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/caraMetade/header.php"; ?>

<div class="container">

    <!-- Forgot password form -->
    <div class="forgotpassword-Form">
        <form  action="reset_password.php" name="forgotpassword-Form" class="form-forgot" method="post">
            <h3 class="cnt">Introduza a nova password.</h3>
            <hr class="colorgraph">
            <label for="password3">Nova password<span class="red">*</span>:</label>
            <input type="password" name="password3" id="password3" placeholder="Nova password" class="input form-control" autocomplete="off" required>
            <label for="password2">Repita a password<span class="red">*</span>:</label>
            <input type="password" name="password2" id="password2" placeholder="Repita a nova password" class="input form-control" autocomplete="off" required><br>
            <input type="text" name="email" value="<?php  echo htmlentities($_GET['email']); ?>" hidden >
            <input type="text" name="codigo" value="<?php echo htmlentities($_GET['codigo']); ?>" hidden >
                        
            <input type="submit"  name="updatePassword" value="Actualizar password" class="btn btn-lg btn-block submit" />  
        </form>
        
    </div>  <!-- End Forgot password form-->
</div> 

