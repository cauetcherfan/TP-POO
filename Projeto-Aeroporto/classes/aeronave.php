<?php
require_once('global.php');

class Aeronave extends persist {
  protected string $regAero;
  protected string $fabricante;
  protected string $modelo;
  protected int $capacidadePassageiro;
  protected float $capacidadeCarga;
  protected CompanhiaAerea $companhia;
  protected static $local_filename = "aeronave.txt";

  static public function getFilename() {
      return get_called_class()::$local_filename;
  }

    public function __construct(string $registroAeronave_, string $fabricante_, string $modelo_, int $capacidadePassageiro_, int $capacidadeCarga_, CompanhiaAerea $companhia_) {
  
    $this->regAero = $registroAeronave_;
    $this->fabricante = $fabricante_;
    $this->modelo = $modelo_;
    $this->capacidadePassageiro = $capacidadePassageiro_;
    $this->capacidadeCarga = $capacidadeCarga_;
    $this->companhia = $companhia_;
    $this->trataRegistro($this->regAero);
  }
  
  protected function trataRegistro(string $regAero){

      if(strlen($regAero) != 6)  
        throw new Exception("Registro Inválido: Registro deve possuir 6 caracteres incluindo o hífen\n");
      
      
      if($regAero[0] != 'P')
          throw new Exception("RegistroAero Inválido: Primeira letra do prefixo deve ser P\n");
      
      if(preg_match("/[^PTRS]/", $regAero[1]))
        throw new Exception("RegistroAero Inválido: Segunda letra do prefixo deve ser: P, T, R ou S\n");
      
      
      if($regAero[2] != '-')
        throw new Exception("RegistroAero Inválido: Terceiro caracter deve ser um hífen\n");
      
      if(preg_match("/[^-A-Z]/", $regAero))
        throw new Exception("RegistroAero Inválido: Apenas letras maiusculas\n");
  
      else
          return 1;     
}

  public function getAssentos()
  {
    return $this->capacidadePassageiros;
  }

  public function getCia()
  {
    return $this->companhia;
  }

  public function getSigla()
  {
    return $this->regAero;
  }
}