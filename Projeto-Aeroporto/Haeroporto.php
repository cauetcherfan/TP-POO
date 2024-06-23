<?php

include_once("classes/aeroporto.php");

$sigla = $_GET['sigla'];
$cidade = $_GET['cidade'];
$estado = $_GET['estado'];

$aeroporto = new aeroporto($sigla, $cidade, $estado);
$aeroporto->save();

$array = aeroporto::getRecords();

?>

<head>
  <title>Página</title>
  <h1>Lista de aeroportos já registrados</h1>
  <link rel="stylesheet" href="styles/index.css"> 
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