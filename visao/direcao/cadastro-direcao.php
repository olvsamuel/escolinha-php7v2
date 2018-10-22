<?php
session_start();
ob_start();
include_once '../../util/helper.class.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro Pessoas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type='text/css' href="../../assets/css/style.css">
    <script src="../../vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Cadastro de Pessoas</h1>

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
                <a class="nav-link" href="cadastro-direcao.php">Cad. Pessoas <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-direcao.php">Cons. Pessoas</a>
              </li>

            </ul>
          </div>
        </nav>
        <?php
        echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
        unset($_SESSION['msg']);
        ?>
        <form name="cadpessoa" method="post" action="">
          <div class="form-group">
            <input type="text" name="txtnome" placeholder="Nome" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="txtsexo" placeholder="Sexo" class="form-control">
          </div>
          <div class="form-group">
            <input type="number" name="numdia" placeholder="Dia Nascimento" class="form-control">
          </div>
          <div class="form-group">
            <input type="number" name="nummes" placeholder="Mes Nascimento" class="form-control">
          </div>
          <div class="form-group">
            <input type="number" name="numano" placeholder="Ano Nascimento" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="txtcpf" placeholder="CPF" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
    
        <?php
        
          if(isset($_POST['cadastrar'])){
            include_once '../../modelo/pessoa.class.php';
            include_once '../../dao/pessoadao.class.php';
            include_once '../../util/padronizacao.class.php';
            include_once '../../util/validacao.class.php';

            $qErros=0;
            if (!Validacao::validarNome($_POST['txtnome'])) {
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
            if (!Validacao::validarDatanasc($_POST['numdia'], $_POST['nummes'], $_POST['numano'])) {
                $qErros++;
                echo "<div class='alert alert-danger' role='alert'>
                    Data Nascimento Inválida!
                 </div>";
            }
            if (!Validacao::validarCpf($_POST['txtcpf'])) {
                $qErros++;
                echo "<div class='alert alert-danger' role='alert'>
                    CPF Inválido!
                    </div>";
            }




            if ($qErros == 0) {
                $pDAO = new PessoaDAO();

                $p = new Pessoa();
                
                $p->nome = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtnome']));
                $p->sexo = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtsexo']));
                $p->datanasc = Padronizacao::antiXSS(Padronizacao::juntarData($_POST['numdia'],$_POST['nummes'],$_POST['numano']));
                $p->cpf = Padronizacao::antiXSS($_POST['txtcpf']);
                
                
                $pDAO->cadastrarPessoa($p);

                $_SESSION['msg'] = "Pessoa cadastrada com sucesso!";
                header("location:consulta-direcao.php");

            }
        }
        ?>
      </div>
  </body>
</html>
