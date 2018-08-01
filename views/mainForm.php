<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/caraMetade/header.php";
//Post Params incluir
?>
<?php //  include_once "$_SERVER[DOCUMENT_ROOT]/header.php";    ?>
<head>
    <style>
        form label {
            float: left;
            width: 150px;
            margin-bottom: 5px;
            margin-top: 5px;
        }
        .clear {
            display: block;
            clear: both;
            width: 100%;
        }
        /*Search bar*/
        input[type=text] { 
            width: 20%;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: white;
            background-image: url('searchicon.png');
            background-position: 10px 10px; 
            background-repeat: no-repeat;
            padding: 12px 20px 12px 40px;
        }
    </style>

<div id="content" class="container-fluid background"> 
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
                <a href="/caraMetade/perfil.php">Account settings</a><br>

                <!-- Back to main page -->  
                <a href="../logout.php">Back to main page</a>

            </center></p>
        </div>
    </div>
</div>

