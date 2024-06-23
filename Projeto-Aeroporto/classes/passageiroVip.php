<?php

include_once("passageiro.php")
include_once("voo.php")
require_once('global.php');

Class PassageiroVip extends Passageiro {

  protected bool $checaFranquia;
  protected string $numeroRegistro;
  protected array $categoria;
  protected string $programaFav;
  protected array $pontos;
  protected array $dataPontos;
  protected int $franquiaGratuita;
  protected int $franquiaAdicionalDesconto;
  protected bool $alteraVoo;
  protected bool $cancelarVoo;

  protected static $local_filename = "passageiroVip.txt";

  public function __construct(string $numeroRegistro_, string $programaFav_, array $pontos_){
    $this->numeroRegistro = $numeroRegistro_;
    $this->programaFav = $programaFav_;
    $this->pontos = $pontos_;
  }

  public function modificaVoo(voo $voo_){
    $this->voo = $voo_;
  }
//função para verificar a validade dos pontos e limpar os pontos que já expiraram
  public function validaPontos(array $pontos_, array $dataPontos_){
    $n = sizeof($dataPontos_);
    $dataAtual = date('Y-m-d');
    $dataLimite = date('Y-m-d', strtotime($dataAtual, ' - 1 years'));
    for ($i = 0; $i < $n; $i++) { 
        if($dataPontos_[i] < $dataLimite){
          unset($dataPontos_[i]);
          unset($pontos_[i]);
        }
    }

  public function getfranquiaGratuita() {
    return $this->franquiaGratuita;
  }

  public function getfranquiaAdicionalDesconto() {
    return $this->franquiaAdicionalDesconto;
  }

  public function alterarVoo($novoVoo) {
    if ($this->alteracaoVooSemCusto) {
      $this->voo = $novoVoo;
      return true;
    } else {
      return false;
    }
  }

  public function cancelarVoo() {
    if ($this->cancelamentoVooSemCusto) {
      $this->voo = null;
      return true;
    } else {
      return false;
    }
  }