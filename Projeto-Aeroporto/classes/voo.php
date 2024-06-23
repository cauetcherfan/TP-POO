<?php

require_once('global.php');
include_once("aeronave.php");
include_once("companhiaAerea.php");
  
  class Voo extends persist {
    protected string $id;
    protected aeronave $aeronave;
    protected companhiaAerea $companhiaAerea;
    protected aeroporto $aeroportoPartida;    
    protected aeroporto $aeroportoChegada;    
    protected string $frequencia;          //criar trataFrequencia?
    protected int $duracaoMinutos;
    protected string $duracaoFormatado;
    protected float $preco;
    protected DateTime $horaPartida;
    protected static $localFilename = "voo.txt";

    static public function getFilename() {
        return get_called_class()::$localFilename;
    }

    public function __construct(string $id_, aeronave $aeronave_, aeroporto $aeroportoP, aeroporto $aeroportoC, string $frequencia_, int $duracaoMinutos_, float $preco_, DateTime $horaPartida_)
    {
        
        $this->id = $id_;
        $this->aeronave = $aeronave_;
        $this->companhiaAerea = $aeronave_->getCia();
        $this->aeroportoPartida = $aeroportoP;
        $this->aeroportoChegada = $aeroportoC;
        $this->frequencia = $frequencia_;
        $this->duracaoMinutos = $duracaoMinutos_;
        $this->preco = $preco_;
        $this->horaPartida = $horaPartida_;
        $this->formatarDuracao($duracaoMinutos_);
      }
    
      private function formatarDuracao(int $duracaoMinutos_){
        $formatado = new Datetime();
        $formatado->setTime(0, $duracaoMinutos_, 0);
        $this->duracaoFormatado = $formatado->format('H:i:s');

        $this->trataId($this->id, $this->companhiaAerea);
      }

      public function imprimeDuracao(){
        echo "Duração estimada do voo: ", $this->duracaoFormatado, "\n";
      }
    
      public function alteraAeronave($aeronave_){
        $this->aeronave = $aeronave_;
        $this->companhiaAerea = $aeronave_->getCia();
      }

      protected function trataId(string $id_, companhiaAerea $cia){
          
        if(strlen($id_) != 6){
            throw new Exception("IdVoo Inválido: Id deve possuir 6 char\n");
        }
        
        if(!ctype_digit($id_[2]) || !ctype_digit($id_[3]) || !ctype_digit($id_[4]) || !ctype_digit($id_[5]))
            throw new Exception("IdVoo Inválido: Os últimos quatro caracteres devem ser números\n");

          return $this->compara($id_, $cia);
      }

      protected function compara(string $id_, companhiaAerea $cia_){
        if(substr($id_, 0,2) == $cia_->getSigla())
          return 1;
        // echo substr($id_, 0,2);
        // echo $cia_->getSigla();
        throw new Exception("IdVoo Inválido: Id não corresponde à sigla da companhia\n");
      }

    public function precoBagagem()
    {return $this->companhiaAerea->getPrecoBagagem();}

    public function getId()
    {return $this->id;}
    
    public function getAeronave()
    {return $this->aeronave;}
    
    public function getCompanhiaAerea()
    {return $this->companhiaAerea;}
    
    public function getAeroportoPartida()
    {return $this->aeroportoPartida;}
    
    public function getAeroportoChegada()
    {return $this->aeroportoChegada;}
    
    public function getFrequencia()
    {return $this->frequencia;}
    
    public function getDuracaoMinutos()
    {return $this->duracaoMinutos;}
    
    public function getPreco()
    {return $this->preco;}
    
    public function getHoraPartida()
    {return $this->horaPartida;}
    
  }