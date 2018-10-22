<?php
class Aluno {

  private $idaluno;
  private $n1;
  private $n2;
  private $media;
  private $faltas;
  private $statusaluno;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}

  public function calcularMedia(): float{
    return ($this->n1 + $this->n2) / 2;
  }

  public function verificarStatus(): string{
    if ($this->calcularMedia()>=6) { 
        return "ap";
    }
    return "rp";
  }

  public function __toString(){
    return nl2br("");
  }//fecha toString

  
}//fecha classe
