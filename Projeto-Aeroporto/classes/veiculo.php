<?php
require_once('global.php');

class Veiculo extends persist {
  
  protected string $modelo;
  protected sting $placa;
  protected int $capacidade;
  protected float $velocidadeMedia;

  public function Cadastro($modelo_, $placa_, $capacidade_, $velocidadeMedia_){
      $this->$modelo = $modelo_;
      $this->$placa = $placa_;
      $this->$capacidade = $capacidade_;
      $this->$velocidadeMedia = $velocidadeMedia_;
    }

}