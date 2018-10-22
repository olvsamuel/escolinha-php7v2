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
      <th>N1</th>
      <th>N2</th>
      <th>Média</th>
      <th>Faltas</th>
      <th>Status</th>
      <th>Turma</th>
      <th>PDF</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Nome</th>
      <th>N1</th>
      <th>N2</th>
      <th>Média</th>
      <th>Faltas</th>
      <th>Status</th>
      <th>Turma</th>
      <th>PDF</th>
    </tr>
  </tfoot>
  <tbody>

    <?php
    $pDAO = new PessoaDAO();
    $ps = $pDAO->buscarPessoa($u);
    $u = unserialize($_SESSION['privateUser']);
    
    $aDAO = new AlunoDAO();
    $as = $aDAO->buscarAluno($u);
    $u = unserialize($_SESSION['privateUser']);

    
    foreach ($ps as $p) {
        
    }

    //sei la, funcionou
    foreach($as as $a){

    }

    $tDAO = new TurmaDAO();
    $ts = $tDAO->buscarTurma($a);
    $u = unserialize($_SESSION['privateUser']);

    foreach ($ts as $t) {
        
    }
    
    foreach($as as $a){ 
        echo "<tr>";
        echo "<td>$p->nome</td>";
        echo "<td>$a->n1</td>";
        echo "<td>$a->n2</td>";
        echo "<td>$a->media</td>";
        echo "<td>$a->faltas</td>";
        echo "<td>$a->statusaluno</td>";
        echo "<td>$t->nome</td>";
        echo "<td>
        <form name='pdfboletim' method='post' action=''>
            <div class='form-group'>
                <input type='submit' name='pdfboletim' value='PDF Boletim' class='btn btn-primary'>
            </div>
        </form>
        </td>";
      echo "</tr>";
    }


    ?>
  </tbody>
</table>
</div><!-- table responsive -->



<form name="pdfboletim" method="post" action="">
  <div class="form-group">
    <input type="submit" name="pdfboletim" value="PDF Boletim" class="btn btn-primary">
  </div>
</form>

<?php   
        



        if(isset($_POST['pdfboletim'])){

            foreach ($ps as $p) {
            
            }
            foreach($as as $a){}
            foreach ($ts as $t) {
            
            }
            //$boletim = '<h1>'.$p->nome.'</h1>';
            foreach($as as $a){
                $html='
                <p>Nome do Aluno: '.$p->nome.'<p>
                <p>Nota 1: '.$a->n1.'<p>
                <p>Nota 2: '.$a->n2.'<p>
                <p>Média: '.$a->media.'<p>
                <p>Faltas: '.$a->faltas.'<p>
                <p>Status: '.$a->statusaluno.'<p>
                <p>Disciplina: '.$t->nome.'<p>
                ';
            }

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