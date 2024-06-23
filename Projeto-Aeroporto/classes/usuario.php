<?php
require_once ('global.php');
include_once("logEscrita.php");

class Usuario extends persist {
  private string $login;
  private string $senha;
  private string $email;
  protected static $localFilename = "usuario.txt";

    static public function getFilename()
  {
    return get_called_class()::$localFilename;
  }

  public function __construct(string $senha_, string $email_, string $login_){
    $this->senha = $senha_;
    $this->email = $email_;
    $this->login = $login_;
    $log = new LogEscrita("usuario", NULL, $this);
    
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getSenha()
  {
    return $this->senha;
  }
}