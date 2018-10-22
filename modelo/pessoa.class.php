<?php
class Pessoa {

  private $idpessoa;
  private $nome;
  private $sexo;
  private $datanasc;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}

  public function __toString(){
    return nl2br("nome: $this->nome Data Nascimento: $this->datanasc sexo: $this->sexo");
  }//fecha toString

  
}//fecha classe
