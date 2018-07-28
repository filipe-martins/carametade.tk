<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Full membership system</title>

        <meta name="description" content="Cara Metade. Site encontros amorosos.">
        <meta name="keywords" content="cara metade, PHP, queca, encontros, uma noite, encontros amorosos, amor ">
        <meta name="author" content="Filipe Martins">

        <!-- Include Bootstrap .css -->
        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
        <!-- Bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="css/bootstrap/js/bootstrap.min.js"></script>
        <!-- Custom .css -->
        <link rel="stylesheet" href="css/custom/custom.css">
        <!-- Custom font -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    </head>

    <header>

        <!-- Navbar -->
        <nav class="navbar navbar-default">

            <div class="container-fluid">

                <div class="container">

                    <!-- Collapse navigation menu for mobiles -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>   <!-- /Collapse menu -->

                    <!-- Logo -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php" >
                            Cara Metade 
                        </a>    
                    </div>  <!-- /Logo -->

                    <!-- Navigation buttons -->
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (!isset($_SESSION['username'])): ?>
                                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
                            <?php else: ?>
                                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
                                <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Registrar</a></li>
                                <?php endif; ?>
                        </ul>
                    </div> <!-- /Navigation buttons -->

                </div>  <!-- /Container -->

            </div>  <!-- /Container-fluid -->

        </nav>  <!-- /Navbar -->

    </header>