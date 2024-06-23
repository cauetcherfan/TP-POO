<?php
include_once("log.php");
require_once("global.php");

  class LogLeitura extends Log{
    protected string $classeAcessada;
    protected string $informacaoAcessada;

    protected static $local_filename = "logLeitura.txt";

    static public function getFilename()
    {
      return get_called_class()::$local_filename;
    }
    
    public function __construct(string $classeAcessada_, string informacaoAcessada_){
      $this->classeAcessada = $classeAcessada_;
      $this->informacaoAcessada = $informacaoAcessada_;
    }
  }