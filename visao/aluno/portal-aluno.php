<?php
session_start();
ob_start();
include_once '../../util/helper.class.php';
include_once '../../dao/pessoadao.class.php';
include_once '../../dao/alunodao.class.php';

if(isset($_SESSION['privateUser'])){
  include_once "../../modelo/usuario.class.php";
  $u = unserialize($_SESSION['privateUser']);

  if($u->tipo != "aluno"){
    $_SESSION['msg'] = "Você não tem permissão de acesso!";
    header("location:../../index.php");
    return;
  }
}else{
  $_SESSION['msg'] = "Você não está logado!";
  header("location:../../index.php");
  return;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Portal Aluno</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type='text/css' href="../../assets/css/style.css">
    <script src="../../vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

</head>
<body>
<div class='container'>
<div class="jumbotron">
  <div class="form-group d-flex justify-content-center">
    <img src="../../img/puc-logo.png" alt='PUCLOGO'>
  </div>
  <h1 class="h1hello display-4 form-group d-flex justify-content-center">Olá, 
    <?php
        $pDAO = new PessoaDAO();
        $ps = $pDAO->buscarPessoa($u);
        $u = unserialize($_SESSION['privateUser']);
        foreach ($ps as $p) {
          echo "$p->nome";
        }
        
        /*
        N1 DO ALUNO

        $aDAO = new AlunoDAO();
        $as = $aDAO->buscarAluno($u);
        $u = unserialize($_SESSION['privateUser']);
        foreach ($as as $a){
          echo "$a->n1";
        }*/
    ?>
  </h1>
  
  <hr class="my-4">
  <h2>
    Seja bem-vindo ao seu portal do aluno!
  </h2>
  <!--<p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>-->
</div>

<div class="row">

  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="hovereffect">
        <img class="img-responsive" src="../../img/new/p3.jpg" alt="">
        <div class="overlay">
           <h2>Meus Dados</h2>
           <a class="info" href="dados-aluno.php">Clique aqui</a>
        </div>
    </div>
  </div>
  <hr>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="hovereffect">
        <img class="img-responsive" src="../../img/new/p2.jpg" alt="">
        <div class="overlay">
           <h2>Notas e Faltas</h2>
           <a class="info" href="notas-aluno.php">Clique aqui</a>
        </div>
    </div>
  </div>
  <hr>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="hovereffect">
        <img class="img-responsive" src="../../img/new/p1.jpg" alt="">
        <div class="overlay">
           <h2>Curso e Disciplina</h2>
           <a class="info" href="cursos-aluno.php">Clique aqui</a>
        </div>
    </div>
  </div>
  <hr>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="hovereffect">
        <img class="img-responsive" src="../../img/new/p4.jpg" alt="">
        <div class="overlay">
           <h2>Meus Dados</h2>
           <a class="info" href="#">Clique aqui</a>
        </div>
    </div>
  </div>
  <hr>



</div>
 <br><br><br>























<?php
    echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
    unset($_SESSION['msg']);
?>

<form name="deslogar" method="post" action="">
  <div class="form-group">
    <input type="submit" name="deslogar" value="Sair" class="btn btn-primary">
  </div>
</form>

<?php
      if(isset($_POST['deslogar'])){
        unset($_SESSION['privateUser']);
        header("location:../../index.php");
      }
?>
</div><!--container-->





<!-- gambiarra pra linkar css?????? -->
<style>
  <?php include '../../assets/css/style.css'; ?>
</style>
</body>
</html>