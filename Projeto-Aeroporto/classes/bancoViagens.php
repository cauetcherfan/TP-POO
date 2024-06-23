<?php
include_once("viagem.php");
require_once('global.php');


class BancoViagens extends persist {
  
  protected static $local_filename = "bancoViagens.txt";
  protected array $viagensDiretas;

  static public function getFilename() {
      return get_called_class()::$local_filename;
  }

  public function __construct (array $viagemDireta = []) {
     echo "\nBanco criado!";
  }

  public function adicionarViagem ( viagem $v){
      $this->viagensDiretas[] = $v;
  }

  public function acharViagem ( aeroporto $aeroPartida, aeroporto $aeroChegada, dateTime $dataSaida, companhiaAerea $ciaUnica = null, companhiaAerea $ciaMista = null){
    $dataLimiteProcura = clone $dataSaida;
    $dataLimiteProcura-> modify("+1 day");
    $dataLimiteProcura-> setTime(23, 55, 0);
    
    // echo var_dump($dataSaida);
    // echo var_dump($dataLimiteProcura);

    //Buscar viagens dentro do intervalo de 48 horas apos a data desejada e serão armazenadas dentro do array $viagensDoDia
    $viagensDoDia = array();  

    //$ciaUnica = viagens somente da cia especificada
    //$ciaMista = escalas devem possuir pelo menos uma viagem com a cia especificada

    if($ciaUnica == null){
      foreach($this->viagensDiretas as $viagem)
      {
          if(($viagem->getDataPartida() >= $dataSaida) && ($viagem->getDataPartida() <= $dataLimiteProcura)) 
              $viagensDoDia[] = $viagem;
      }
    } else{
       foreach($this->viagensDiretas as $viagem)
      {
        if($viagem->getCompanhiaAerea() == $ciaUnica){
            if(($viagem->getDataPartida() >= $dataSaida) && ($viagem->getDataPartida() <= $dataLimiteProcura)) 
              $viagensDoDia[] = $viagem;
        }
      }
    }

        // echo var_dump($viagensDoDia);

      // viagens que possuem a partida desejada 
      $opcoesPartida = array();
      
      foreach($viagensDoDia as $viagem)
      {
          if($viagem->getAeroportoPartida() == $aeroPartida)
              $opcoesPartida[] = $viagem;
      }

        // echo var_dump($opcoesPartida);
    
      //array com todas as viagens diretas
      $viagensDiretas = array();
    
      
      foreach($opcoesPartida as $viagem)
      {
          if($viagem->getAeroportoChegada() == $aeroChegada)
              $viagensDiretas[] = $viagem;
      }
            
      
      if(!empty($viagensDiretas))
      {
          // Retornar o array: existe viagem direta
          echo "\nExiste ao menos uma viagem direta!\n\n\n";
          // echo var_dump($viagensDiretas);
          return $viagensDiretas;
      }
      
    //SEGUNDA VERIFICAÇÃO: viagem indireta
      //array com todas as viagens com destino desejado
      $opcoesChegada = array();
      
      foreach($viagensDoDia as $viagem)
      {
          if($viagem->getAeroportoChegada() == $aeroChegada)
              $opcoesChegada[] = $viagem;
      }

      //array com todas as possiveis viagens indiretas
      $viagensIndiretas = array();
    
      foreach($opcoesPartida as $primeiro)
      {
          foreach($opcoesChegada as $segundo)
          {
              if($primeiro->getAeroportoChegada() == $segundo->getAeroportoPartida())
              {
                if($primeiro->getDataPartida() < $segundo->getDataPartida())
                {
                  if($ciaMista == null)
                  {
                    $viagensIndiretas[] = array($primeiro, $segundo);
                  } elseif($primeiro->getCompanhiaAerea() == $ciaMista || $segundo->getCompanhiaAerea() == $ciaMista){
                    $viagensIndiretas[] = array($primeiro, $segundo);
                  }
                }
              }
          }
      }

    foreach($viagensIndiretas as $array){
      echo "\n\n\n";
      foreach($array as $viagem){
        {
          echo "\n";
          echo $viagem->getId();
          echo var_dump($viagem->getDataPartida());
          echo "\n";
        }
      }
    }
    
      echo "\nViagens indiretas encontradas!";
      // echo var_dump($viagensIndiretas);
      return $viagensIndiretas;
      
    }
  
}