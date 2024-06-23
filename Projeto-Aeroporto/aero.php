<!DOCTYPE html>
 
<?php
  include_once("classes/companhiaAerea.php");

  $array = companhiaAerea::getRecords();
?>


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible"content="IE=edge">
  <link rel="stylesheet" href="styles/index.css"> 
  <title>Aeronave</title>
</head>

<body>
  <h2 class="title-h2">Cadastrando uma aeronave</h2>
  <div class="div-formulario">
    <form action="Haeronave.php" method="get" id="form-aeroporto">
        <label>Insira o registro: </label><br>
        <input name="registro" type="text"> </input><br><br>
        <label>Insira o fabricante: </label><br>
        <input name="fabricante" type="text"> </input><br><br>
        <label>Insira o modelo: </label><br>
        <input name="modelo" type="text"> </input><br><br>
        <label>Insira a capacidade de passageiros: </label><br>
        <input name="passageiros" type="number"> </input><br><br>
        <label>Insira a capacidade de carga (em kg): </label><br>
        <input name="carga" type="number"> </input><br><br>
        <label>Insira a companhia Aérea associada: </label><br>

        <select name="cia">

        <?php
          foreach($array as $item)
          {
        ?>
          
            <option value="<?php echo $item->getNome();?>" > <?php echo $item->getNome();?> </option>

        <?php
          }
        ?>

        </select>
      
        <br><br>
        <button type="submit">Cadastrar</button>
        <p>Para voltar ao início, clique <a href="index.html">aqui.</a></p>
    </form>
  </div>
</body>