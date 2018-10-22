<?php
session_start();
ob_start();
include_once 'util/helper.class.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Portal Acadêmico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>


<?php
    echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
    unset($_SESSION['msg']);
?>


<div class="container ">
    <div class="login">
        <div class="form-group d-flex justify-content-center">
            <img src="img/puc-logo.png" alt='PUCLOGO'>
        </div>
        <form action=""  method="POST" name="formulario" > 

            <div class="form-group">
                <div class="col-md-4 offset-md-4">
                    <label > RA </label>
                    <input type="text" name="txtlogin" class="form-control " placeholder=" RA " required="" >    
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4 offset-md-4">
                    <label> SENHA </label>  
                    <input type="password" name="txtsenha" class="form-control" placeholder="SENHA" required="" >
                </div>
            </div>      

            <div class="form-group">
                <div class="col-md-4 offset-md-4">
                    <div class="form">
                        <input type="submit" value="Login" class="btn btn-primary btn-block" name="entrar">
                        <input type="reset" value="Limpar" class="btn btn-danger btn-block" name="limpar">
                    </div>            
                </div>
            </div>
        </form> 
    </div>

<?php
    if(isset($_POST['entrar'])){
      include 'modelo/usuario.class.php';
      include 'dao/usuariodao.class.php';
      include 'util/seguranca.class.php';

      $u = new Usuario();
      $u->login = $_POST['txtlogin'];
      $u->senha = Seguranca::criptografar($_POST['txtsenha']);

      //echo $u;

      $uDAO = new UsuarioDAO();
      $usuario = $uDAO->verificarUsuario($u);
      
      if($usuario == null){
        //Helper::alert("Usuário e/ou senha inválidos!");
        echo "<div class='col-md-4 offset-md-4 alert alert-danger' role='alert'> Login e/ou Senha inválidos! </div>";
      }else{

        //testando usuarios, ISSO NAO É GAMBIARRA OK
        /*$aluno = $uDAO->verificarAluno($u);
        $professor = $uDAO->verificarProfessor($u);*/

        $user = $uDAO->gambiarraNao($u);

        $_SESSION['privateUser'] = serialize($usuario);

        if ($user == true){
            $u->tipo = 'professor';
            header("location:visao/professor/portal-professor.php");
            return;
        }else if($user == false){
            $u->tipo = 'aluno';
            header("location:visao/aluno/portal-aluno.php");
            return;
        }else{
            echo "tem erro em algum lugar";
        }

        /*if($aluno == null && $professor != null){
            header("location:visao/professor/portal-professor.php");
            return;
        }else if($aluno != null && $professor == null){
            header("location:visao/aluno/portal-aluno.php");
            return;
        }else{
            echo "deu erro em algum lugar ai";
        }*/
      }

    }
    ?>
</div>
</body>
</html>