<?php

require_once("../global.php");
include_once("../classes/companhiaAerea.php");

$codigo = $_GET['codigo'];
$nome = $_GET['nome'];
$razao = $_GET['razao'];
$cnpj = $_GET['cnpj'];
$sigla = $_GET['sigla'];
$bagagem = $_GET['bagagem'];

$cia = new companhiaAerea($codigo, $nome, $razao, $cnpj, $sigla, $bagagem);
$cia->save();

$array = companhiaAerea::getRecords();

?>

<head>
  <title>Página</title>
  <link rel="stylesheet" href="styles/index.css"> 
  <h1>Lista de companhias aéreas já registradas</h1>
</head>

<body>
  <div>
        <?php
          foreach($array as $item)
          {
        ?>
          <ol>
            <il> <?php echo $item;?> </il>
          </ol>
        <?php
          }
        ?>
  </div>
</body>