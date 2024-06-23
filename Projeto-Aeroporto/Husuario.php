<?php

include_once("classes/usuario.php");

$login = $_GET['login'];
$email = $_GET['email'];
$senha = $_GET['senha'];

$usuario = new Usuario($senha, $email, $login);
$usuario->save();

?>

<head>
  <title>Página</title>
</head>

<body>
  <div>
    <p>Usuário cadastrado e salvo no sistema!</p>
    <p>Se deseja cadastrar um aeroporto, clique <a href="Faeroporto.html">aqui.</a></p>
    <p>Se deseja cadastrar uma companhia aérea, clique <a href="FcompanhiaAerea.html">aqui.</a></p>
    <p>Se deseja cadastrar uma aeronave, clique <a href="aero.php">aqui.</a></p>
  </div>
</body>