<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html>
<html>
    <title>W3.CSS Template</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="site de encontros, encontros, Lisboa, homem procura mulher, mulheres para convivio, homens procurando mulheres" lang="pt">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
    </style>
    <link rel="stylesheet" type="text/css" href="/carametade/css/style.css">
    <body class="w3-light-grey w3-content" style="max-width:1600px">

        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:300px">

            <!-- Header -->
            <header id="CaraMetade">
                <div class="w3-container">
                    <form action="/caraMetade/procurar.php">
                        <h4><b>Procura</b></h4>

                        <div class="inline">
                            <span>Procuro</span>
                            <select  name="procuro">
                                <option value="1">Mulher</option>
                                <option value="2">Homem</option>
                            </select>
                        </div>

                        <!--distrito-->
                        <div class="inline">
                            <span>Distrito</span>
                            <select name="distrito">
                                <option value="1">Lisboa</option>
                                <option value="2">Porto e região Norte</option>
                                <option value="3">zona Centro</option>
                                <option value="4">Alentejo</option>
                                <option value="5">Algarve</option>
                                <option value="6">Madeira</option>
                                <option value="7">Açores</option>
                            </select>
                        </div>

                        <!--idade inf-->
                        <div class="inline">
                            <span>Idade entre</span>
                            <select name="idadeInf">
                                <?php
                                for ($i = 18; $i <= 75; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!--idade sup-->
                        <div class="inline">
                            <span>e</span>
                            <select name="idadeSup">
                                <?php
                                for ($i = 18; $i <= 75; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <button class="w3-btn w3-red w3-tiny" style="margin: 40px">Procurar</button>
                    </form>
            </header>    

            <!--construir lista de resultados da procura--> 
            <?php
            foreach ($_SESSION['lstProcura'] as $campos => $valores) {
                echo '<p>' . $valores['nome'] . '</p>';    
//                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>

