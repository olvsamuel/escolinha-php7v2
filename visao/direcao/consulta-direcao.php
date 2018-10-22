<?php
session_start();
ob_start();

include_once '../../dao/pessoadao.class.php';
include_once '../../modelo/pessoa.class.php';
include_once '../../util/helper.class.php';

$pDAO = new PessoaDAO();
$array = $pDAO->buscarTdPessoa();
//TESTE!!!!!!
//var_dump($array);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Consulta Pessoas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type='text/css' href="../../assets/css/style.css">
    <script src="../../vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

</head>
<body>
  <div class="container">
    <h1 class="jumbotron bg-info">Consulta de Pessoas</h1>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Sistema</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="../../index.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="cadastro-direcao.php">Cad. Pessoas </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-direcao.php">Cons. Pessoas<span class="sr-only">(current)</span></a>
          </li>

        </ul>
      </div>
    </nav>

    <h2>Consulta de Pessoas!</h2>
    <?php
    if(isset($_SESSION['msg'])){
      Helper::alert($_SESSION['msg']);
      unset($_SESSION['msg']);
    }

    if(count($array) == 0){
        echo "<h2>Não há Pessoas no banco!</h2>";
        return;
    }
    ?>

    <form name="filtrar" method="post" action="">

      <div class="row">
        <div class="form-group col-md-6">
          <input type="text" name="txtfiltro"
                 placeholder="Digite a sua pesquisa" class="form-control">
        </div>

        <div class="form-group col-md-6">
          <select name="selfiltro" class="form-control">
            <option value="todos">Todos</option>
            <option value="codigo">Código</option>
            <option value="nome">Nome</option>
            <option value="cpf">CPF</option>
          </select>
        </div>
      </div> <!-- fecha row -->

      <div class="form-group">
        <input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary btn-block">
      </div>
    </form>
    <?php
    if(isset($_POST['filtrar'])){
      $pesquisa = $_POST['txtfiltro'];
      $filtro = $_POST['selfiltro'];

      if(!empty($pesquisa)){
        $pDAO = new PessoaDAO();
        $array = $pDAO->filtrar($pesquisa,$filtro);

        if(count($array) == 0){
          echo "<h3>Sua pesquisa não retornou nenhuma pessoa!</h3>";
          return;
        }

      }else{
        echo "Digite uma pesquisa!";
      }//fecha else

    }//fecha if
    ?>

    <div class="table-responsive">
      <table class="table table-striped table-hover table-dark table-bordered table-condensed">
        <thead>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Data Nascimento</th>
            <th>Sexo</th>
            <th>CPF</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Data Nascimento</th>
            <th>Sexo</th>
            <th>CPF</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach($array as $p){ //<- é um L
            echo "<tr>";
              echo "<td>$p->idpessoa</td>";
              echo "<td>$p->nome</td>";
              echo "<td>$p->datanasc</td>";
              echo "<td>$p->sexo</td>";
              echo "<td>$p->cpf</td>";
              echo "<td><a href='consulta-direcao.php?id=$p->idpessoa' class='btn btn-danger'>Excluir</a></td>";
              echo "<td><a href='alterar-direcao.php?id=$p->idpessoa' class='btn btn-warning'>Alterar</a></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div><!-- table responsive -->
  </div>
  <?php
  if(isset($_GET['id'])){
    $pDAO->deletarPessoa($_GET['id']);
    $_SESSION['msg'] = "Pessoa excluída com sucesso!";
    header("location:consulta-direcao.php");
  }
  ?>
</body>
</html>
