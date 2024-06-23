<?php
include_once("log.php");
require_once("global.php");

  class logEscrita extends Log{
    protected string $classeAlterada;
    protected string $objAntes;
    protected string $objPos;
   
    protected static $local_filename = "logEscrita.txt";

    static public function getFilename()
    {
      return get_called_class()::$local_filename;
    }

    public function __construct(string $classeAlterada_, mixed $objAntes_, Usuario $usuario_, $now = new DateTime()){
      parent::__construct($usuario_, $now);
      $this->classeAlterada = $classeAlterada_;
      $this->objAntes = serialize($objAntes_);
    }
  
    public function setObjetoPos($objPos_){
      $this->objPos = serialize($objPos_);
    }
  }
  

  //   public function imprime(){
  //     echo($this->objAntes);
  //     echo("\n");
  //     echo($this->objPos);
  //   }
  // }