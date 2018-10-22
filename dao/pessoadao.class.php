<?php
require_once 'conexaobanco.class.php';
 class PessoaDAO { //DATA ACCESS OBJECT

   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}


   public function cadastrarPessoa($p){
      try {
          $stat = $this->conexao->prepare("insert into pessoa (idpessoa, nome, sexo, datanasc, cpf)
                                            values(null, ?, ?, ?, ?)");
          $stat->bindValue(1, $p->nome);
          $stat->bindValue(2, $p->sexo);
          $stat->bindValue(3, $p->datanasc);
          $stat->bindValue(4, $p->cpf);
          $stat->execute();
      }
      catch (PDOException $e) {
          echo "Erro ao cadastrar pessoa! " . $e;
      }
   }

   public function buscarPessoa($u){
       try {
           $stat = $this->conexao->prepare("select * from pessoa where idpessoa = ?");
           $stat->bindValue(1, $u->idUsuario);
           $stat->execute();
           $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Usuario');
           return $array;
       }
       catch (PDOException $e) {
           echo "Erro ao buscar usuario! " . $e;
       }
   }

   public function alterarPessoa($p){
    try{
      $stat = $this->conexao->prepare("update pessoa set nome = ?, datanasc = ?, sexo = ?, cpf = ? where idpessoa = ?");

      $stat->bindValue(1, $p->nome);
      $stat->bindValue(2, $p->datanasc);
      $stat->bindValue(3, $p->sexo);
      $stat->bindValue(4, $p->cpf);
      $stat->bindValue(5, $p->idpessoa);

      $stat->execute();

    }catch(PDOException $e){
      echo "Erro ao alterar Pessoa! ".$e;
    }//fecha catch
  }//fecha alterarPessoas

  public function filtrar($pesquisa, $filtro){
    try{
      $query = "";
      switch($filtro){
        case "todos": $query = "";
        break;
        case "codigo": $query = "where idpessoa = ".$pesquisa;
        break;
        case "nome": $query = "where nome like '%".$pesquisa."%'";
        break;
        case "cpf": $query = "where cpf like '%".$pesquisa."%'";
        break;

      }

      $stat = $this->conexao->query("select * from pessoa {$query}");
      $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Pessoa');
      return $array;

    }catch(PDOException $e){
      echo "Erro ao filtrar Pessoas. ".$e;
    }//fecha catch
  }//fecha filtrar


  //teste
  public function buscarPessoaProfessor($pr){
    try {
        $stat = $this->conexao->prepare("select * from pessoa where idpessoa = ?");
        $stat->bindValue(1, $pr->idpessoa);
        $stat->execute();
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Professor');
        return $array;
    }
    catch (PDOException $e) {
        echo "Erro ao buscar professor! " . $e;
    }
}

// refazer/arrumar
public function buscarTdPessoa(){
  try {
      $stat = $this->conexao->prepare("select * from pessoa");
      $stat->execute();
      $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Pessoa');
      return $array;
  }
  catch (PDOException $e) {
      echo "Erro ao buscar usuario! " . $e;
  }
}

public function deletarPessoa($id){
  try{
    $stat = $this->conexao->prepare("delete from pessoa where idpessoa = ?");
    $stat->bindValue(1, $id);
    $stat->execute();
  }catch(PDOException $e){
    echo "Erro ao excluir livro! ".$e;
  }//fecha catch
}//fecha deletarLivro

 }//fecha classe
