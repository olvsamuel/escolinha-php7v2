<?php
class ConexaoBanco extends PDO {

  private static $instance = null;

  public function __construct($dsn, $user, $pass){
    //chamando construtor da classe pai
    parent::__construct($dsn,$user,$pass);
  }

  public static function getInstance(){
    try{
        if(!isset(self::$instance)){ //padrao SINGLETON
          /* Criar uma conexão */
          self::$instance = new
          ConexaoBanco("mysql:dbname=escolav2;host=localhost","root","");
        }
        return self::$instance; //N ESQUECER!!
    }catch(PDOException $e){
        echo "Erro ao conectar no banco! ".$e;
    }//fecha catch
  }//fecha getInstance
  
}//fecha classe
