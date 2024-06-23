<?php
require_once('global.php');

class CompanhiaAerea extends persist {
    protected string $codigo;
    protected string $nome;
    protected string $razaosocial;
    protected string $cnpj;
    protected string $sigla;
    protected float $precoBagagem;
    protected static $local_filename = "companhiaAerea.txt";

    static public function getFilename() {
        return get_called_class()::$local_filename;
    }

    public function __construct(string $codigo_, string $nome_, string $razaosocial_, string $cnpj_, string $sigla_, float $precoBagagem_)
    {
      $this->codigo = $codigo_;
      $this->nome = $nome_;
      $this->razaosocial = $razaosocial_;
      $this->cnpj = $cnpj_;
      $this->sigla = $sigla_;
      $this->precoBagagem = $precoBagagem_;

        //       if(!$this->trataSigla($sigla_)){
        //    echo ("Sigla Inválida");
        //    return 0;
        // }
      $this->trataSigla($this->sigla);
    }
        
    protected function trataSigla(string $sigla_){
        if(strlen($sigla_) != 2 || !ctype_upper($sigla_))
            throw new Exception("SiglaCia Inválido: Sigla deve ter dois char alfabéticos maiúsculos\n");
          
        else
            return 1;
    }

    public function getSigla()
      {return $this->sigla;}

    public function getNome()
      {return $this->nome;}

    public function getPrecoBagagem()
      {return $this->precoBagagem;}
}
