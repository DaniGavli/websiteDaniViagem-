<?php
session_start();
?>

<?php
 require_once 'conexao_banco.php';

 
    if(!isset($_POST['usuario']) || ($_POST['usuario']== "") || ($_POST['senha']) || ($_POST['senha']== "")){
							
		 $usuario = $_POST['usuario'];
		 $senha = $_POST['senha'];

     $validarlogin = $conexao->query("SELECT * FROM usuario WHERE cpf_usuario = $usuario and senha_usuario = $senha");
    $validarlogin = $conexao->prepare("SELECT * FROM usuario WHERE cpf_usuario = $usuario and senha_usuario = $senha");
    $validarlogin->execute();

    if($validarlogin->rowCount() == 1) {
        while($ln = $validarlogin->fetch(PDO::FETCH_ASSOC)){
			
            $_SESSION['cpf_usuario'] = $ln['cpf_usuario'];
            $_SESSION['senha_usuario'] = $ln['senha_usuario'];
            $_SESSION['nome_usuario'] = $ln['nome_usuario'];
			$_SESSION['codUsuario'] = $ln['codUsuario'];

			echo  "<script>alert('Logado Com Sucesso!');</script>"; 
            echo"<script> location.replace('index.php'); </script>";
               
        }
       
        
    }else  {
        
		echo  "<script>alert('Usuarios Ou Senha Incorretos!');</script>";  
			echo"<script> location.replace('Login.html'); </script>";
			
          
    }
    }