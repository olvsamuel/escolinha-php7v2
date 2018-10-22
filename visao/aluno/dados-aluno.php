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
  


<div class="table-responsive">
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th>Nome</th>
      <th>Data Nascimento</th>
      <th>Sexo</th>
      <th>CPF</th>
      <th>Alterar</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Nome</th>
      <th>Data Nascimento</th>
      <th>Sexo</th>
      <th>CPF</th>
      <th>Alterar</th>
    </tr>
  </tfoot>
  <tbody>

    <?php
    $pDAO = new PessoaDAO();
    $ps = $pDAO->buscarPessoa($u);
    $u = unserialize($_SESSION['privateUser']);
    
  
    foreach ($ps as $p) {
      echo "<tr>";
      echo "<td>$p->nome</td>";
      echo "<td>$p->datanasc</td>";
      echo "<td>$p->sexo</td>";
      echo "<td>$p->cpf</td>";
      echo "<td><a href='alterar-aluno.php?id=$p->idpessoa' class='btn btn-warning'>Alterar</a></td>";
    echo "</tr>";
    }
    
    ?>
  </tbody>
</table>
</div><!-- table responsive -->



<form name="pdfaluno" method="post" action="">
  <div class="form-group">
    <input type="submit" name="pdfaluno" value="PDF Aluno" class="btn btn-primary">
  </div>
</form>

<?php

        //$boletim = '<h1>'.$p->nome.'</h1>';
        $html='
            <h1>Nome do Aluno: ' .$p->nome.' </h1>
            <h1>Sexo: ' .$p->sexo.' </h1>
            <h1>Data Nascimento: ' .$p->datanasc.' </h1>
            <h1>CPF: ' .$p->cpf.' </h1>

        ';



        if(isset($_POST['pdfaluno'])){

        

        ob_clean();


        $dompdf = new Dompdf();

        $dompdf->load_html($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream(
            "dados.pdf", 
            array(
                "Attachment" => true
            )
        );
 
      }
?>









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
        header("location:portal-aluno.php");
      }
?>
</div>



<!-- gambiarra pra linkar css?????? -->
<style>
  <?php include '../../assets/css/style.css'; ?>
</style>
</body>