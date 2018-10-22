<?php
require_once 'conexaobanco.class.php';
 class ProfessorDAO { 

   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}


   public function buscarProfessor($a){
       try {
           $stat = $this->conexao->prepare("select * from professor where idcurso = ?");
           $stat->bindValue(1, $a->idcurso);
           $stat->execute();
           $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Professor');
           return $array;
       }
       catch (PDOException $e) {
           echo "Erro ao buscar usuario! " . $e;
       }
   }


 }//fecha classe
