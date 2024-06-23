<?php

require_once('global.php');
include_once("viagem.php");

class Passageiro extends persist {

  protected date $dataNascimento;
  protected string $cpf;
  protected string $nacionalidade;
  protected string $email;
  protected string $nome;
  protected DateTime $embarque;

  protected static $local_filename = "passagem.txt";
  
  static public function getFilename() {
      return get_called_class()::$local_filename;
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

  public function verificaCPF($cpf) {mult
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

  public function armazenaViagem(Viagem $viagem_){
      array_push($v->viagens, $viagem_);
  }

  public function __construct(DateTime $embarque_){
      $this->embarque = $embarque_;
  }

  public function __construct (string $nome_, date $nascimento_, string $cpf_, string $nacionalidade_, string $email_){
     $this->nome = $nome_;
     $this->nascimento = $nascimento_;
     $this->cpf = $cpf_;
     $this->nacionalidade = $nacionalidade_;
     $this->email = $email_;
  }
}