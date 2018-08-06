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
    <link rel="stylesheet" type="text/css" href="/caraMetade/css/style.css">
</head>

<body>
    <form id="form1" name="form1" method="post" action="perfil.php">
        <div class="vertical-align: sub">          
        <label for="Nome">Nome: *</label><input type="text" name="Nome" id="Nome" style=""/>
        </div>
        <br class="clear" /> 
        <!--<label for="Distrito">Distrito</label><input type="text" name="Distrito" id="Distrito" />-->
        <span>Distrito: *</span>
        <select name="distrito"  >
            <?php
            foreach ($_SESSION['lstDistritos'] as $campos => $valores) {
//                echo '<p>' . $valores['nome'] . '</p>';
                echo '<option value="' . $valores['id'] . '">' . $valores['distrito'] . '</option>';
            }
            ?>
        </select>
        <br class="clear" /> 
        <label for="Nome">Cidade: *</label><input type="text" name="Cidade" id="Cidade"/>
        <br class="clear" /> 
        <label for="Data de Nascimento">Data de Nascimento: *</label><input type="text" name="Data_Nasc" id="Data de Nascimento" />
        <br class="clear" /> 
        <label for="Estado Civil">Estado Civil: </label><select name="Estado Civil" id="Estado Civil">
            <option value="Sol.">Solteiro</option>
            <option value="Sol.">Namora</option>
            <option value="Cas.">Casado</option>
            <option value="Div.">Divorciado</option>
            <option value="Viu.">Viúvo.</option>
        </select>
        <br class="clear" /> 
        <label for="Habilitações">Habilitações: </label><input type="text" name="Habilitacoes" id="Habilitações" />
        <br class="clear" /> 
        <label for="Nome">Profissao:</label><input type="text" name="Profissao" id="Profissao"/>
        <br class="clear" /> 
        <label for="foto">Foto: </label><input type="file" name="foto" id="foto" />
        <br class="clear" /> 
        <label for="Descrição">Descrição: </label><input type="text" name="Descricao" id="Descrição" />
        <br class="clear" /> 
        <label for="Procura">Procura: *</label><select name="Procura" id="Procura">
            <option value="H">Homem</option>
            <option value="M">Mulher</option>
        </select>
        <br class="clear" /> 
        <label for="Altura">Altura: </label><input type="text" name="Altura" class="l-small" id="Altura" />
        <br class="clear" /> 
        <label for="Peso">Peso: </label><input type="text" name="Peso" class="l-small" id="Peso" />
        <br class="clear" /> 
        
        <label for="Peso" style="color: tomato">* Campos Obrigatorios</label>
        <br class="clear" /> 
        
        <button class="w3-btn w3-red w3-tiny" style="margin: 10px 0 0  225px">Guardar</button>
    </form>
</body>
