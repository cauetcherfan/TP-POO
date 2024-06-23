<?php
include_once("classes/companhiaAerea.php");
include_once("classes/voo.php");
include_once("classes/aeroporto.php");
include_once("classes/aeronave.php");
include_once("classes/passagem.php");
include_once("classes/viagem.php");
include_once("classes/cartaoEmbarque.php");
include_once("classes/bancoViagens.php");
// include_once("classes/usuario.php");
// include_once("classes/log.php");
// include_once("classes/logEscrita.php");
// include_once("classes/transporte.php");
require_once('global.php');

function main()
  {
    # criando duas companhias aéreas
    try
    {
      $cia1 = new companhiaAerea('001', 'Latam', 'Latam Airlines do Brasil S.A.', '11.222.333/4444-55', 'LA', 100);

    } catch(Exception $b)
    {
      echo 'Exceção capturada: ',  $b->getMessage(), "\n";
      $cia1 = new companhiaAerea('001', 'Latam', 'Latam Airlines do Brasil S.A.', '11.222.333/4444-55', 'LA', 100);
    }

      $cia2 = new companhiaAerea('002', 'Azul', 'Azul Linhas Aéreas Brasileiras S.A.', '22.111.333/4444-55', 'AD', 150);
    $cia1->save();
    $cia2->save();
    
    # criando aeronaves
    
    $aeronaveL1 = new aeronave('PP-RUZ', 'Embraer', '175', 180, 600, $cia1);
    $aeronaveL2 = new aeronave('PT-RAZ', 'Coton', '175', 180, 600, $cia1);
    $aeronaveL3 = new aeronave('PT-RIZ', 'TicoTico', '15', 90, 300, $cia1);
    $aeronaveL4 = new aeronave('PT-ROZ', 'Tang', '120', 120, 400, $cia1);
    $aeronaveL5 = new aeronave('PT-REZ', 'Nostro', '215', 100, 350, $cia1);
    
    try
    {  
     $aeronaveA1 = new aeronave('PX-RUZ', 'Embraer', '175', 180, 600, $cia2);
    } catch(Exception $e)
    {
      echo 'Exceção capturada: ',  $e->getMessage(), "\n";
      $aeronaveA1 = new aeronave('PP-RUZ', 'Embraer', '175', 180, 600, $cia2);
      echo 'A sigla foi corrigida para ', $aeronaveA1->getSigla(),  " e o objeto foi inicializado!\n\n";
    }

    $aeronaveA2 = new aeronave('PT-RAZ', 'Coton', '175', 180, 600, $cia2);
    $aeronaveA3 = new aeronave('PT-RIZ', 'TicoTico', '15', 90, 300, $cia2);
    $aeronaveA4 = new aeronave('PT-ROZ', 'Tang', '120', 120, 400, $cia2);
    $aeronaveA5 = new aeronave('PT-REZ', 'Nostro', '215', 100, 350, $cia2);
    
    $aeronaveA1->save();
    $aeronaveA2->save();
    
    # cadastrando aeroportos
    $aeroporto1 = new aeroporto('CFN', 'Belo Horizonte', 'MG'); //Confins
    $aeroporto2 = new aeroporto('GRU', 'Sao Paulo', 'SP'); //Garulhos
    $aeroporto3 = new aeroporto('CGH', 'Sao Paulo', 'SP'); //Congonhas
    $aeroporto4 = new aeroporto('GIG', 'Rio de Janeiro', 'RJ');// Galeão
    $aeroporto5 = new aeroporto('CWB', 'Curitiba', 'PR');// Afonso Pena
    
  # cadastrando voo
    $horario1 = new DateTime();
  $horario1->setTime(7, 0, 0); # 7h da manhã?
    $horario2 = new DateTime();
  $horario2->setTime(15, 0, 0); # 15h da tarde?
  
    try
  {
    $vooL12 = new voo("LL1312", $aeronaveL1, $aeroporto1, $aeroporto2, "Diário", 120, 500, $horario1);
   } catch(Exception $a)
  {
    echo 'Exceção capturada: ',  $a->getMessage(), "\n";
    $vooL12 = new voo("LA1312", $aeronaveL1, $aeroporto1, $aeroporto2, "Diário", 120, 500, $horario1);
    echo 'O código de voo foi alterado para ', $vooL12->getId(), " e o objeto voo foi inicializado\n";
  }
    $vooL21 = new voo("LA1321", $aeronaveL1, $aeroporto2, $aeroporto1, "Diário", 120, 16, $horario2);
    $vooA12 = new voo("AD1312", $aeronaveA1, $aeroporto1, $aeroporto2, "Diário", 120, 500, $horario1); 
    $vooA21 = new voo("AD1321", $aeronaveA1, $aeroporto2, $aeroporto1, "Diário", 120, 16, $horario2);

    
    $vooL13 = new voo("LA8513", $aeronaveL2, $aeroporto1, $aeroporto3, "Diário", 120, 500.35, $horario1);
    $vooL31 = new voo("LA8531", $aeronaveL2, $aeroporto3, $aeroporto1, "Diário", 120, 500.35, $horario2);
    $vooA13 = new voo("AD8513", $aeronaveA2, $aeroporto1, $aeroporto3, "Diário", 120, 500.35, $horario1);
    $vooA31 = new voo("AD8531", $aeronaveA2, $aeroporto3, $aeroporto1, "Diário", 120, 500.35, $horario2);
    
    $vooL24 = new voo("LA1324", $aeronaveL3, $aeroporto2, $aeroporto4, "Diário", 120, 10, $horario1);
    $vooL42 = new voo("LA1342", $aeronaveL3, $aeroporto4, $aeroporto2, "Diário", 120, 16, $horario2);
    $vooA24 = new voo("AD1324", $aeronaveA3, $aeroporto2, $aeroporto4, "Diário", 120, 10, $horario1);
    $vooA42 = new voo("AD1342", $aeronaveA3, $aeroporto4, $aeroporto2, "Diário", 120, 16, $horario2);
    
    $vooL35 = new voo("LA1335", $aeronaveL4, $aeroporto3, $aeroporto5, "Diário", 120, 10, $horario1);
    $vooL53 = new voo("LA1353", $aeronaveL4, $aeroporto5, $aeroporto3, "Diário", 120, 17, $horario2);
    $vooA35 = new voo("AD1335", $aeronaveA4, $aeroporto3, $aeroporto5, "Diário", 120, 10, $horario1);
    $vooA53 = new voo("AD1353", $aeronaveA4, $aeroporto5, $aeroporto3, "Diário", 120, 17, $horario2);

    $voos = array();
    array_push($voos, $vooA12, $vooA21, $vooA13, $vooA31, $vooA24, $vooA42, $vooA35, $vooA53, $vooL12, $vooL21, $vooL13, $vooL31, $vooL24, $vooL42, $vooL35, $vooL53);

    $Banco = new BancoViagens();

    //criacao de viagens para os proximos 30 dias
    forEach($voos as $voo){
  
      if($voo->getFrequencia() == "Diário"){
        for($i=0; $i<30; $i++){
           $data = clone $voo->getHoraPartida();
           $data->modify("+$i days");
           $viagem = new Viagem($voo, $data, 50, 38.5);
           $Banco->adicionarViagem($viagem);
        }
      }
      elseif($voo->getFrequencia() == "Semanal"){
        for($i=0; $i<5; $i++){
           $dias = 7*$i;
           $data = clone $voo->getHoraPartida();
           $data->modify("+$dias days");
           $viagem = new Viagem($voo, $data, 50, 38.5);
           $Banco->adicionarViagem($viagem);
        }
      }
    }

    //data escolhida como amanha pelo usuario para viagem de ida, somente pela AZUL
    
    $dataDesejadaIda = new DateTime();
    $dataDesejadaIda-> setTime(0, 1, 0);
    $dataDesejadaIda-> modify("+1 day");
    $ciaUnica = clone $cia2;

    
    $Banco->acharViagem($aeroporto1, $aeroporto5, $dataDesejadaIda, $ciaUnica);

    
    //data escolhida 2 dias apos a ida, passando por pelo menos 1 da LATAM
    $dataDesejadaVolta = clone $dataDesejadaIda;
    $dataDesejadaVolta-> modify("+2 days");
    $ciaMista = clone $cia1;
    
    // echo var_dump($viagensIndiretas);
    $Banco->acharViagem($aeroporto5, $aeroporto1, $dataDesejadaVolta, null, $ciaMista);
  }

main();