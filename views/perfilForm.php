<?php
header("Content-Type: text/html;  charset=ISO-8859-1", true);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8">-->
    <!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">-->
    <style>
        form label {
            float: left;
            width: 150px;
            margin-bottom: 5px;
            margin-top: 5px;
        }
        form {
            margin: 40px;
            padding: 200px, 200px;
            border: 1px dotted red;

        }
        /*form padding{20, 20}*/
        .clear {
            display: block;
            clear: both;
            width: 100%;
        }
        input[type=text] {
            width: 50%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #555;
            outline: none;
        }

        input[type=text]:focus {
            background-color: lightblue;
        }
        select {
            width: 100%;
            padding: 16px 20px;
            border: none;
            border-radius: 4px;
            background-color: #f1f1f1;
        }

    </style>

<form id="form1" name="form1" method="post" action="perfil.php">
    <label for="Nome">Nome</label><input type="text" name="Nome" id="Nome" />
    <br class="clear" /> 
    <label for="Distrito">Distrito</label><input type="text" name="Distrito" id="Distrito" />
    <br class="clear" /> 
    <label for="Data de Nascimento">Data de Nascimento</label><input type="text" name="Data de Nascimento" id="Data de Nascimento" />
    <br class="clear" /> 
    <label for="Estado Civil">Estado Civil</label><select name="Estado Civil" id="Estado Civil">
        <option value="Sol.">Sol.</option>
        <option value="Cas.">Cas.</option>
        <option value="Div.">Div.</option>
        <option value="Viu.">Viu.</option>
    </select>
    <br class="clear" /> 
    <label for="Habilitações">Habilitações</label><input type="text" name="Habilitações" id="Habilitações" />
    <br class="clear" /> 
    <label for="foto">Foto</label><input type="file" name="foto" id="foto" />
    <br class="clear" /> 
    <label for="Descrição">Descrição</label><input type="text" name="Descrição" id="Descrição" />
    <br class="clear" /> 
    <label for="Procura">Procura</label><select name="Procura" id="Procura">
        <option value="H">H</option>
        <option value="M">M</option>
    </select>
    <br class="clear" /> 
    <label for="Altura">Altura</label><input type="text" name="Altura" id="Altura" />
    <br class="clear" /> 
    <label for="Peso">Peso</label><input type="text" name="Peso" id="Peso" />
    <br class="clear" /> 
</form>
