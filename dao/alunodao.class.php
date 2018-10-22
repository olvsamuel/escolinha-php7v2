<?php
require_once 'conexaobanco.class.php';
 class AlunoDAO {

   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}


   public function buscarAluno($u){
       try {
           $stat = $this->conexao->prepare("select * from aluno where idpessoa = ?");
           $stat->bindValue(1, $u->idUsuario);
           $stat->execute();
           $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Usuario');
           return $array;
       }
       catch (PDOException $e) {
           echo "Erro ao buscar usuario! " . $e;
       }
   }


   public function buscarTdAluno(){
        try {
            $stat = $this->conexao->prepare("select * from aluno");
            $stat->execute();
            $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Usuario');
            return $array;
        }
        catch (PDOException $e) {
            echo "Erro ao buscar usuario! " . $e;
        }
    }

    public function filtrar($pesquisa, $filtro){
        try{
          $query = "";
          switch($filtro){
    
            case "codigo": $query = "where idaluno = ".$pesquisa;
            break;
    
          }
    
          $stat = $this->conexao->query("select * from aluno {$query}");
          $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Aluno');
          return $array;
    
        }catch(PDOException $e){
          echo "Erro ao filtrar Alunos. ".$e;
        }//fecha catch
    }//fecha filtrar

    public function alterarAluno($a){
        try{
          $stat = $this->conexao->prepare("update aluno set n1 = ?, n2 = ?, media = ?, faltas = ?, statusaluno = ? where idaluno = ?");
    
          $stat->bindValue(1, $a->n1);
          $stat->bindValue(2, $a->n2);
          $stat->bindValue(3, $a->media);
          $stat->bindValue(4, $a->faltas);
          $stat->bindValue(5, $a->statusaluno);
          $stat->bindValue(6, $a->idaluno);
    
          $stat->execute();
    
        }catch(PDOException $e){
          echo "Erro ao alterar Pessoa! ".$e;
        }//fecha catch
      }//fecha alterarPessoas

 }//fecha classe
