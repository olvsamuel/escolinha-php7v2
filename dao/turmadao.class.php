<?php
require_once 'conexaobanco.class.php';
 class TurmaDAO { //DATA ACCESS OBJECT

   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}


   public function buscarTurma($u){
       try {
           $stat = $this->conexao->prepare("select * from turma where idturma = ?");
           $stat->bindValue(1, $u->idturma);
           $stat->execute();
           $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Usuario');
           return $array;
       }
       catch (PDOException $e) {
           echo "Erro ao buscar turma! " . $e;
       }
   }


 }//fecha classe
