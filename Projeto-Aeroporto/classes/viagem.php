<?php
require_once('global.php');
include_once("aeroporto.php");
include_once("voo.php");
include_once("bancoViagens.php");

  class Viagem extends Voo {
    protected DateTime $dataPartida;
    protected DateTime $dataChegada;
    protected array $tripulacao;
    protected int $pontos;
    protected float $multaAlteracao;
    protected array $assentos;
    protected static $localFilename = "viagem.txt";

    public function __construct(voo $voo, DateTime $dataPartida_, int $pontos_, float $multaAlteracao_, array $tripulacao_ = [], array $assentos_ = []){
      parent::__construct($voo->getId(), $voo->getAeronave(), $voo->getAeroportoPartida(), $voo->getAeroportoChegada(), $voo->getFrequencia(), $voo->getDuracaoMinutos(), $voo->getPreco(), $voo->getHoraPartida());
      $this->dataPartida = $dataPartida_;
      $data = clone $dataPartida_;
      $this->dataChegada = $data->modify("+$this->duracaoMinutos minutes");
      $this->tripulacao = $tripulacao_;
      $this->pontos = $pontos_;
      $this->multaAlteracao = $multaAlteracao_;
      $this->assentos = $assentos_;
    }

    
    public function getAeroChegada()
    {return $this->aeroportoChegada;}

    public function getAeroPartida()
    {return $this->aeroportoPartida;}

    public function getDataPartida()
    {return $this->dataPartida;}
    
    public function getMultaAlteracao()
    { return $this->multaAlteracao;}

    }