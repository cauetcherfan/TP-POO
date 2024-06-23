<?php

require_once('global.php');
include_once("viagem.php");
include_once("aeroporto.php");
  
  class Passagem extends persist {

    protected string $aeroportoOrigem;
    protected string $aeroportoDestino;
    protected array $viagens;
    protected float $tarifa;
    protected array $assentosEscolhidos;
    protected bool $passagemAdquirida;
    protected bool $passagemCancelada;
    protected bool $checkInRealizado;
    protected bool $embarqueRealizado;
    protected bool $noshow;
    
    protected int $assento;

  protected static $local_filename = "passagem.txt";
  static public function getFilename() {
      return get_called_class()::$local_filename;
  }
    
  public function __construct(aeroporto $origem, aeroporto $destino)
    {
    $this->aeroportoOrigem = $origem;
    $this->aeroportoDestino = $destino;

    $this->viagens = $this->acharViagens($origem, $destino);
    }
    
    public function acharViagens($aeroportoOrigem, $aeroportoDestino){
      $viagensAeroOrigem = $aeroportoOrigem->getViagensDiretas(); 
      foreach($viagens as $item){
        if($voo->aeroportoChegada == $aeroportoDestino)
          echo "!";
            //usar a função que checa o 2 elemento de um array com o primeiro de outro
        
      }
    }
  
    public function selecionarAssentos($assento_)
    {
      $nomeAssento = $passageiro->nome;
      assentosEscolhidos[$assento_] == $nomeAssento;
    }
    
    public function calculaTarifa($viagem)
    {
      echo("$this->viagem->teste()");
    }

    public function checkIn()
    {
      $this->checkInRealizado = true;
    }
    public function pontuaPassageiro(bool $embarque, PassageiroVip $p, Viagem $v)
    {
      if(!($embarque == true))
        return 0;
      array_push($p->pontos, $v->pontos);
      array_push($p->dataPontos, $v->dataPartida);
    }
  }