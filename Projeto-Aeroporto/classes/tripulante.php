<?php
require_once('global.php');
include_once("aeroporto.php");
include_once("companhiaAerea.php");
include_once("endereco.php");

class Tripulante extends persist {
  
  protected string $tipoTripulante;
  protected sting $nomecompleto;
  protected string $documento;
  protected string $cpf;
  protected date $dataNascimento;
  protected sting $nacionalidade;
  protected string $email;
  protected string $cht;
  protected Endereco $endereco;
  protected CompanhiaAerea $companhia;
  protected Aeroporto $aeroportoBase;

  public function __construct($tipoTripulante_, $nomecompleto_, $documento_, $cpf_, $dataNascimento_, $nacionalidade_, $email_, $cht_, $endereco_, $companhia_, $aeroportoBase_){
      $this->$tipoTripulante = $tipoTripulante_;
      $this->$nomecompleto = $nomecompleto_;
      $this->$documento = $documento_;
      $this->$cpf = $cpf_;
      $this->$dataNascimento = $dataNascimento_;
      $this->$nacionalidade = $nacionalidade_;
      $this->$email = $email_;
      $this->$cht = $cht_;
      $this->$endereco = $endereco_;
      $this->$companhia = $companhia_;
      $this->$aeroportoBase = $aeroportoBase_;
    }

  public function verificaNascimento(date $nascimento_){
    $nascimento_ = str_replace("/", "-", $data); // Substitui as barras por hífens
    $nascimento_ = date('Y-m-d', strtotime($data)); // Converte para o formato ISO 8601

    if ($nascimento_ === false) {
        // A data é inválida
        return false;
    }

    $dataAtual = date('Y-m-d'); // Pega a data atual no mesmo formato

    if ($nascimento_ > $dataAtual) {
        // A data de nascimento é posterior à data atual
        return false;
    }

    return true;
    }

  public function verificaCPF($cpf) {
    // Remove caracteres indesejados
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    // Verifica se o número de dígitos está correto
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcula os dígitos verificadores
    for ($i = 9; $i < 11; $i++) {
        $soma = 0;
        for ($j = 0; $j < $i; $j++) {
            $soma += $cpf[$j] * (($i + 1) - $j);
        }
        $digito = (($soma % 11) < 2) ? 0 : (11 - ($soma % 11));
        if ($cpf[$i] != $digito) {
            return false;
        }
    }

    return true;
  }

  public function verificaEmail($email) {
    // Remove caracteres indesejados
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Verifica se o formato é válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    return true;
  }

   public function verificaCHT($cht) {
    // Verifica se o número de dígitos está correto
    if (strlen($cht) != 5) {
        return false;
    }

    // Verifica se todos os dígitos são iguais
    if (preg_match('/(\d)\1{4}/', $cht)) {
        return false;
    }

    return true;
  }

}