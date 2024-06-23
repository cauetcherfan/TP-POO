<?php

include_once("../classes/aeronave.php");
include_once("../classes/companhiaAerea.php");

$arrayCia = companhiaAerea::getRecords();

$registro = $_GET['registro'];
$fabricante = $_GET['fabricante'];
$modelo = $_GET['modelo'];
$passageiros = $_GET['passageiros'];
$carga = $_GET['carga'];
$cia = $_GET['cia'];

$aeronave = new aeronave($registro, $fabricante, $modelo, $passageiros, $carga);
$aeronave->save();

$arrayAero = aeronave::getRecords();

?>

<head>
  <title>Página</title>
  <h1>Lista de aeronaves já registradas</h1>
  <link rel="stylesheet" href="styles/index.css"> 
</head>

<body>
  <div>
        <?php
          foreach($arrayAero as $item)
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