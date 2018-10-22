<?php
class Professor {

  private $idprofessor;
  private $idpessoa;
  private $idcurso;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}

  public function __toString(){
    return nl2br("");
  }//fecha toString

  
}//fecha classe
