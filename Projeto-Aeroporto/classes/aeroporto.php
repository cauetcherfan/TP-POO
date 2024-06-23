<?php
include_once("viagem.php");
require_once('global.php');


class Aeroporto extends persist {
  
  protected string $sigla;
  protected string $cidade;
  protected string $estado;
  protected array $viagensDiretas;
  protected static $local_filename = "aeroporto.txt";
  protected endereco $endereco_;

  static public function getFilename() {
      return get_called_class()::$local_filename;
  }

  public function __construct (string $sigla_, string $cidade_, string $estado_, array $viagemDireta = []) {
     if(!$this->trataSigla($sigla_)){
        return 0;
     }
     $this->sigla = $sigla_;
     $this->cidade = $cidade_;
     $this->estado = $estado_;
  }

  protected function trataSigla (string $sigla_){
    if(!ctype_upper($sigla_) || strlen($sigla_) != 3){
      echo ("SiglaAero Invalido: Sigla deve ter três letras maiusculas");
      return 0;
    }
    return 1;
  }

  public function adicionaViagemDireta(viagem $v){
      $aeroChegada = $v->getAeroChegada;
      $viagemDireta = array("aeroChegada" => $aeroChegada, "viagem" => $v);
      array_push($this->viagensDiretas, $viagemDireta);
  }
  
  public function getViagensDiretas(){
    return $this->viagensDiretas;    
  }

  public function getSigla()
  {
    return $this->sigla;  
  }
  
  public function salvaAeroporto()
  {
    $this->save();
  }
}
