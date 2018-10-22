<?php
session_start();
ob_start();
include_once '../../util/helper.class.php';

if(isset($_GET['id'])){
  include_once "../../dao/alunodao.class.php";
  include_once "../../modelo/aluno.class.php";

  $aDAO = new AlunoDAO();
  $array = $aDAO->filtrar($_GET['id'], "codigo");

  //var_dump($array);

  $a = $array[0];

}
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
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Portal Professor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type='text/css' href="../../assets/css/style.css">
    <script src="../../vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Alteração de Dados</h1>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Sistema</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="portal-professor.php">Portal</a>
              </li>
              
            </ul>
          </div>
        </nav>
        <br>
        <?php
        echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
        unset($_SESSION['msg']);
        ?>
        <form name="cadnotas" method="post" action="">
          <div class="form-group">
            <label for="txtn1">N1</label>
            <input type="number" name="txtn1" placeholder="Nota 1" class="form-control"
                   value="<?php if(isset($a)){ echo $a->n1; }?>">
                   
          </div>
          <div class="form-group">
            <label for="txtn2">N2</label>
            <input type="number" name="txtn2" placeholder="Nota 2" class="form-control"
                   value="<?php if(isset($a)){ echo $a->n2; }?>">
                   
          </div>
          <div class="form-group">
            <label for="txtmedia">Média</label>
            <input type="text" name="txtmedia" readonly placeholder="Média" class="form-control"
                   value="<?php if(isset($a)){ echo $a->media; }?>">
                   
          </div>
          <div class="form-group">
            <label for="txtfaltas">Faltas</label>
            <input type="text" name="txtfaltas" placeholder="Faltas" class="form-control"
            value="<?php if(isset($a)){ echo $a->faltas; }?>">
            
          </div>
          <div class="form-group">
            <label for="txtstatus">Status</label>
            <input type="text" name="txtstatus" readonly placeholder="Status" class="form-control"
            value="<?php if(isset($a)){ echo $a->statusaluno; }?>">            
          </div>
          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <?php
          //falta código
          if(isset($_POST['alterar'])){
            include_once '../../modelo/aluno.class.php';
            include_once '../../dao/alunodao.class.php';
            include_once '../../util/padronizacao.class.php';
            include_once '../../util/validacao.class.php';

            $qErros=0;
            /*if (!Validacao::validarNome($_POST['txtn1'])) {
                $qErros++;
                echo "<div class='alert alert-danger' role='alert'>
                    Nome Inválido!
                    </div>";
            }
            if (!Validacao::validarSexo($_POST['txtsexo'])) {
                $qErros++;
                echo "<div class='alert alert-danger' role='alert'>
                    Sexo Inválido!
                    </div>";
            }        
            /*if (!Validacao::validarDataNasc($_POST['txtdatanasc'])) {
                $qErros++;
                echo "<div class='alert alert-danger' role='alert'>
                    Data Nascimento Inválida!
                    </div>";
            }*/
            /*if (!Validacao::validarCpf($_POST['txtcpf'])) {
                $qErros++;
                echo "<div class='alert alert-danger' role='alert'>
                    CPF Inválido!
                    </div>";
            }*/




            if ($qErros == 0) {
                $aDAO = new AlunoDAO();

                $a = new Aluno();
                $a->idaluno = $_GET['id'];
                $a->n1 = Padronizacao::antiXSS($_POST['txtn1']);
                $a->n2 = Padronizacao::antiXSS($_POST['txtn2']);
                $a->media = $a->calcularMedia();
                $a->faltas = Padronizacao::antiXSS($_POST['txtfaltas']);
                $a->statusaluno = $a->verificarStatus();
                
                
                $aDAO->alterarAluno($a);

                $_SESSION['msg'] = "Dados alterados com sucesso!";
                header("location:notas-professor.php");

            }
        }
        ?>
      </div>
  </body>
</html>
