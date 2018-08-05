<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/caraMetade/header.php";
//Post Params incluir
?>
<?php //  include_once "$_SERVER[DOCUMENT_ROOT]/header.php";     ?>
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
        <a name="about"></a><h2><center>Bem vindo!</center></h2>         
        <div class="descText center-block">
            <hr class="colorgraph">
            <ul class="nav navbar-nav navbar-center">
                <li><a href="/caraMetade/procurar.php"><span class="glyphicon glyphicon-search"></span> Procurar</a></li>
                <li><a href="/caraMetade/favoritos.php"><span class="glyphicon glyphicon-star-empty"></span> Favoritos</a></li>
                <li><a href="/caraMetade/mensagens.php"><span class="glyphicon glyphicon-inbox"></span> Mensagens</a></li>
                <!--<li><a href="/caraMetade/procurar.php"><img src="/caraMetade/img/proc_coracao.png" width="20" height="20">Procurar</a></li>-->
                <li><a href="/caraMetade/perfil.php"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                <!--<li><a href="/caraMetade/logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>-->
                <li><a href="/caraMetade/logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
            </ul>
            <br>
            <br><br>

            <!-- Profile link -->
            <!--<a href="/caraMetade/perfil.php">Account settings</a><br>-->

            <!-- Back to main page -->  
            <!--<a href="<?= $_SERVER["DOCUMENT_ROOT"] ?>/caraMetade/logout.php">Back to main page</a>-->

            </center></p>
        </div>
    </div>
</div>

