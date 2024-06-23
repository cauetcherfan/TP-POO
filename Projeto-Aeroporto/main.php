<?php
include_once("classes/companhiaAerea.php");
include_once("classes/voo.php");
include_once("classes/aeroporto.php");
include_once("classes/aeronave.php");
include_once("classes/passagem.php");
include_once("classes/viagem.php");
include_once("classes/cartaoEmbarque.php");
include_once("classes/bancoViagens.php");
include_once("classes/usuario.php");
include_once("classes/log.php");
include_once("classes/logEscrita.php");
include_once("classes/transporte.php");
require_once('global.php');

function main() {
  // Criando objeto Companhia aerea
  date_default_timezone_set('America/Sao_Paulo');
  $Banco = new BancoViagens();
  
  $cia1 = new companhiaAerea('codigo', 'TAM', 'Tam LTDA', '01234567894444', 'TM', 77.40);

  $cia1->save();

  // Criando objeto Aeroporto
  $porto1 = new aeroporto('GRU', 'Guarulhos', 'SP');
  $porto2 = new aeroporto('CFN', 'Confins', 'MG');
  $porto3 = new aeroporto('CGH', 'Congonhas', 'SP');

  // Criando objeto Aeronaves
  $aeronave1 = new aeronave('PR-FST', 'Boeing', '747', 300, 150000, $cia1);
  $aeronave2 = new aeronave('PR-FST', 'Bing', '007', 300, 15000, $cia1);
  
  // //Criando objeto voo
  $horarioIda = new DateTime();
  $horarioIda-> setTime(8, 5, 0);
  $horarioVolta = new DateTime();
  $horarioVolta-> setTime(15, 30, 0);
  
  // echo "Capacidade de passageiros da aeronave: " . $aeronave->capacidadePassageiro . "\n";
  
  $voo12 = new voo("TM8556", $aeronave1, $porto1, $porto2, "Diário", 120, 500.35, $horarioIda);
  $voo21 = new voo("TM8556", $aeronave1, $porto2, $porto1, "Diário", 120, 500.35, $horarioVolta);
  $voo32 = new voo("TM1329", $aeronave2, $porto3, $porto2, "Diário", 120, 16, $horarioIda);
  $voo23 = new voo("TM1329", $aeronave2, $porto2, $porto3, "Diário", 120, 16, $horarioVolta);
  
  // criando uma viagem
  $dataAgora = new DateTime();
  

  $voos = array();
  array_push($voos, $voo12, $voo21, $voo32, $voo23);

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

  // echo $Banco;
  $dataDesejada = new DateTime();
  $dataDesejada-> setTime(23, 55, 0);
  $dataDesejada-> modify("+1 day");

  $Banco->acharViagem($porto1, $porto2, $dataDesejada);
  $Banco->acharViagem($porto3, $porto1, $dataDesejada);
  // echo $viagem1;

  //criando cartao de embarque
  $cartao1 = new CartaoEmbarque("pedro", $porto1, $porto2, $horarioIda, 12);
  
  //TESTE LOG
   $usuario = new Usuario("PL302111", "pedro@gmail.com", "pedro01");
  // // $log = new Log($usuario, $data2);
   $logE1 = new LogEscrita("aeronave", $porto1, $usuario);
   $logE1->setObjetoPos($porto2);
   // $logE1->imprime();

  
  //$passagem1 = new Passagem($porto1, $porto2);
  // fazer passageiro rodar primeiro que passagem

  //$passagem1 = new Passageiro($porto1, $porto2);

  $transporte1 = new Transporte("veiculo1",7);
  echo $transporte1;
}

main();