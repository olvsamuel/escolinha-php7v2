<?php
session_start();
ob_start();
include_once '../../util/helper.class.php';
include_once '../../dao/pessoadao.class.php';
include_once '../../dao/alunodao.class.php';
include_once '../../dao/turmadao.class.php';
include_once '../../dao/materiadao.class.php';
include_once '../../dao/professordao.class.php';

use Dompdf\Dompdf;
require_once '../../vendor/autoload.php';




if(isset($_SESSION['privateUser'])){
  include_once "../../modelo/usuario.class.php";
  include_once '../../modelo/professor.class.php';
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
      <th>Turma</th>
      <th>Matéria</th>
      <th>null</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Turma</th>
      <th>Professor</th>
      <th>null</th>
    </tr>
  </tfoot>
  <tbody>

    <?php

    

    $aDAO = new AlunoDAO();
    $as = $aDAO->buscarAluno($u);
    $u = unserialize($_SESSION['privateUser']);


    foreach($as as $a){
        //sei lá... fez "funcionar";
    }

    $tDAO = new TurmaDAO();
    $ts = $tDAO->buscarTurma($a);
    $a = unserialize($_SESSION['privateUser']);
    
  
    foreach ($ts as $t) {
        //echo "<tr>";
            //echo "<td>$t->nome</td>";
            //echo "<td>$p->nome</td>";
            //echo "<td>$m->nome</td>";
        //echo "</tr>";
    }

    $mDAO = new MateriaDAO();
    $ms = $mDAO->buscarMateria($t);

    foreach($ms as $m){
        echo "<tr>";
            echo "<td>$t->nome</td>";
            echo "<td>$m->nome</td>";
            echo "<td>00</td>";
        echo "</tr>";
    }

    /*$pDAO = new ProfessorDAO();
    $ps = $pDAO->buscarProfessor($t);


    foreach($ps as $pr){
        //echo "<tr>";
            //echo "<td>$t->nome</td>";
            //echo "<td>$m->nome</td>";
            ///echo "<td>$pr->nome</td>";
        //echo "</tr>";
    }

    
    $pessoaDAO = new PessoaDAO();
    $pes = $pessoaDAO->buscarPessoaProfessor($pr);
    
    foreach($pes as $prof){
        echo "<tr>";
            echo "<td>$t->nome</td>";
            echo "<td>$m->nome</td>";
            echo "<td>$prof->nome</td>";
        echo "</tr>";
    }*/
    ?>
  </tbody>
</table>
</div><!-- table responsive -->



<form name="pdfdados" method="post" action="">
  <div class="form-group">
    <input type="submit" name="pdfdados" value="PDF Dados" class="btn btn-primary">
  </div>
</form>

<?php
        if(isset($_POST['pdfdados'])){

        ob_clean();

        $html='
            <h1>Nome do Curso: '.$t->nome.'</h1>
            <h2>Nome da matéria: '.$m->nome.'</h2>
        ';

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



<!-- gambiarra pra linkar css?????? -->
<style>
  <?php include '../../assets/css/style.css'; ?>
</style>
</body>