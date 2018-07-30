<?php  include_once $_SERVER["DOCUMENT_ROOT"] . "/caraMetade/header.php"; ?>
<?php //  include_once "$_SERVER[DOCUMENT_ROOT]/header.php"; ?>

<div id="content" class="container-fluid background "> 
    <div class="container description">
        <a name="about"></a><h2><center>Logged In</center></h2>         
        <div class="descText center-block">
            <hr class="colorgraph">
            <p><center>To make page member only please add your content between:
                if($login->isLoggedIn() == true){<br>
                Your content here.<br>
                } tags.
            <br><br>

            <!-- Profile link -->
            <a href="profile.php">Account settings</a><br>

            <!-- Back to main page -->  
            <a href="http://localhost/caraMetade/logout.php">Back to main page</a>

            </center></p>
        </div>
    </div>
</div>
