<?php

include_once("classes/usuario.php");

$email = $_GET['email'];
$senha = $_GET['senha'];
$sucesso = null;

$array = Usuario::getRecords();

?>

<head>
  <title>Página</title>
</head>

<body>
  <div>
      <?php
        foreach($array as $item)
        {
          if($item->getSenha() == $senha && $item->getEmail() == $email)
          {
            $sucesso = $item;
          }
        }

        if($sucesso != NULL){
      ?>
        <p>Login verificado, clique <a href="Husuarioexistente.php">aqui</a> para acessar os serviços disponíveis.</p>
      <?php
        }
        if($sucesso == NULL)
        {
      ?>
        <p>Usuário inexistente, por favor retorne para a página inicial clicando <a href="index.html">aqui</a> e cadastre-se!</p>
    <?php
        }
        ?>
  </div>
</body>