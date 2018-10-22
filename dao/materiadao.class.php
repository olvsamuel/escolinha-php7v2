<?php
require_once 'conexaobanco.class.php';
 class MateriaDAO { 

   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}


   public function buscarMateria($t){
       try {
           $stat = $this->conexao->prepare("select * from materia where idmateria = ?");
           $stat->bindValue(1, $t->idmateria);
           $stat->execute();
           $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Usuario');
           return $array;
       }
       catch (PDOException $e) {
           echo "Erro ao buscar turma! " . $e;
       }
   }

   public function buscarTdMateria(){
    try {
        $stat = $this->conexao->prepare("select * from materia");
        
        $stat->execute();
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Usuario');
        return $array;
    }
    catch (PDOException $e) {
        echo "Erro ao buscar turma! " . $e;
    }
}

    public function filtrar($pesquisa, $filtro){
        try{
        $query = "";
        switch($filtro){
            case "todos": $query = "";
            break;

            case "codigo": $query = "where idmateria = ".$pesquisa;
            break;

            case "nome": $query = "where nome like '%".$pesquisa."%'";
            break;

            
        }

        $stat = $this->conexao->query("select * from materia {$query}");
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Usuario');
        return $array;

        }catch(PDOException $e){
        echo "Erro ao filtrar Materias. ".$e;
        }//fecha catch
    }//fecha filtrar


 }//fecha classe
