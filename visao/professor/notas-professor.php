<?php
session_start();
ob_start();
include_once '../../util/helper.class.php';
include_once '../../dao/pessoadao.class.php';
include_once '../../dao/alunodao.class.php';
include_once '../../dao/turmadao.class.php';
use Dompdf\Dompdf;
require_once '../../vendor/autoload.php';



if(isset($_SESSION['privateUser'])){
  include_once "../../modelo/usuario.class.php";
  $u = unserialize($_SESSION['privateUser']);

  if($u->tipo == "aluno"){
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
    

<div class="table-responsive">
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th>ID</th>
      <th>N1</th>
      <th>N2</th>
      <th>Média</th>
      <th>Faltas</th>
      <th>Status</th>
      <th>Alterar</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>N1</th>
      <th>N2</th>
      <th>Média</th>
      <th>Faltas</th>
      <th>Status</th>
      <th>Alterar</th>
    </tr>
  </tfoot>
  <tbody>

    <?php
    
    $aDAO = new AlunoDAO();
    $as = $aDAO->buscarTdAluno();
    $u = unserialize($_SESSION['privateUser']);

    
    foreach($as as $a){ 
        echo "<tr>";
        echo "<td>$a->idaluno</td>";
        echo "<td>$a->n1</td>";
        echo "<td>$a->n2</td>";
        echo "<td>$a->media</td>";
        echo "<td>$a->faltas</td>";
        echo "<td>$a->statusaluno</td>";
        echo "<td><a href='alterar-aluno-professor.php?id=$a->idaluno' class='btn btn-warning'>Alterar</a></td>";
      echo "</tr>";
    }


    ?>
  </tbody>
</table>
</div><!-- table responsive -->










<?php
    echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
    unset($_SESSION['msg']);
?>

<form name="deslogar" method="post" action="">
  <div class="form-group">
    <input type="submit" name="deslogar" value="Sair" class="btn btn-primary">
  </div>
  <div class="form-group">
    <input type="submit" name="voltarportal" value="Voltar Portal" class="btn btn-primary">
  </div>
</form>

<?php
      if(isset($_POST['deslogar'])){
        unset($_SESSION['privateUser']);
        header("location:../../index.php");
      }
      if(isset($_POST['voltarportal'])){
        header("location:portal-professor.php");
      }
?>
</div>



<!-- gambiarra pra linkar css?????? -->
<style>
  <?php include '../../assets/css/style.css'; ?>
</style>
</body>