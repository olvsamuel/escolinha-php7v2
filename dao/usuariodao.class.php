<?php
require 'conexaobanco.class.php';
 class UsuarioDAO { //DATA ACCESS OBJECT

   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}

   public function verificarUsuario($u){
     try{
       $stat = $this->conexao->prepare("select * from usuario where login = ? and senha = ?");

       $stat->bindValue(1, $u->login);
       $stat->bindValue(2, $u->senha);

       $stat->execute();

       $usuario = null;
       $usuario = $stat->fetchObject('Usuario');
       return $usuario;
     }catch(PDOException $e){
       echo "Erro ao buscar usuarios! ".$e;
     }//fecha catch
   }
   
   public function verificarAluno($u){
    try{
      $stat = $this->conexao->prepare("select * from usuario where login = ? and senha = ? and tipo = ?");

      $stat->bindValue(1, $u->login);
      $stat->bindValue(2, $u->senha);
      $stat->bindValue(3, 'aluno');

      $stat->execute();

      $usuario = null;
      $usuario = $stat->fetchObject('Usuario');
      return $usuario;
    }catch(PDOException $e){
      echo "Erro ao buscar usuarios! ".$e;
    }//fecha catch
   }

   public function verificarProfessor($u){
    try{
      $stat = $this->conexao->prepare("select * from usuario where login = ? and senha = ? and tipo = ?");

      $stat->bindValue(1, $u->login);
      $stat->bindValue(2, $u->senha);
      $stat->bindValue(3, 'professor');

      $stat->execute();

      $usuario = null;
      $usuario = $stat->fetchObject('Usuario');
      return $usuario;
    }catch(PDOException $e){
      echo "Erro ao buscar usuarios! ".$e;
    }//fecha catch
   }

   public function gambiarraNao($u){
    try{
      $stat = $this->conexao->prepare("select * from usuario where login = ? and senha = ? and tipo = ?");

      $stat->bindValue(1, $u->login);
      $stat->bindValue(2, $u->senha);
      $stat->bindValue(3, 'professor');

      $stat->execute();

      $usuario = null;
      $usuario = $stat->fetchObject('Usuario');
      
      return $usuario;
      
    }catch(PDOException $e){
      echo "Erro ao buscar usuarios! ".$e;
    }//fecha catch
   }

 }//fecha classe
