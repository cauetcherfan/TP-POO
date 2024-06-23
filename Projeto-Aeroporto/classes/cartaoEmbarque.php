<?php

  require_once('global.php');

  class CartaoEmbarque extends persist{
    protected string $nomeCompleto;
    protected Aeroporto $aeroportoPartida;
    protected Aeroporto $aeroportoChegada;
    protected datetime $dataEmbarque;
    protected datetime $dataPartida;
    protected int $assentoEscolhido;
    protected static $localFilename = "cartaoembarque.txt";

    static public function getFilename() {
        return get_called_class()::$localFilename;
    }

    public function __construct(string $nomeCompleto_, Aeroporto $aeroportoPartida_, Aeroporto $aeroportoChegada_, datetime $dataPartida_, int $assentoEscolhido_){
      $this->nomeCompleto = $nomeCompleto_;
      $this->aeroportoPartida = $aeroportoPartida_;
      $this->aeroportoChegada = $aeroportoChegada_;
      $this->dataPartida = $dataPartida_;     
      $this->dataEmbarque = $this->calculaEmbarque($dataPartida_); 
      $this->assentoEscolhido = $assentoEscolhido_;
    }

    protected function calculaEmbarque(datetime $data){
      $dataEmbarque = clone $data;
      $dataEmbarque->modify("-40 minutes");
      return $dataEmbarque;
    }
  }