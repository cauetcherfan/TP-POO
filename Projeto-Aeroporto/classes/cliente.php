<?php
require_once('global.php');

  class Cliente extends persist {

    protected string $nome;
    protected string $sobrenome;
    protected string $documento;
    protected array $bagagem;

    public function Cadastro($nome_, $sobrenome_, $documento_, $bagagem_){
      $this->$nome = $nome_;
      $this->$sobrenome = $sobrenome_;
      $this->$documento = $documento_;
      $this->$bagagem = $bagagem_;
    }
  
  }