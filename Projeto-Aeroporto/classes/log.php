<?php
require_once("global.php");
include_once("usuario.php");

    abstract class Log extends persist{

      protected Usuario $usuario;
      protected DateTime $data;

      #tava escrito companhiaAerea.txt, mudei pra log
      protected static $local_filename = "log.txt";

      static public function getFilename() {
        return get_called_class()::$local_filename;
      }

      public function __construct(Usuario $usuario_, DateTime $data_){
        $this->usuario = $usuario_;
        $this->data = $data_;
      }

      public function getUsuario()
      {return $this->usuario;}

      public function getData()
      {return $this->data;}
      
    }