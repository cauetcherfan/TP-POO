<?php

  require_once ('global.php');
  include_once ('passageiroVip.php')

  class SistemaMilhas extends persist {

      protected string $nome;
      protected array $categorias;
      protected PassageiroVip $p;

      public function Cadastro(string $nome_, array $categorias_){
        $this->nome = $nome_;
        $this->categorias = $categorias_;
      }

      public function atualizaCategoria(PassageiroVip $p, array $categorias_){
        $n = sizeof($p->pontos);
        $soma = 0;
        for($i = 0; $i < $n; i++){
           $soma += $pontos[i]; 
        }
            
      }
  }