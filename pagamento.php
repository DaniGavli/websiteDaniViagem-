<?php
session_start();
?>

<?php
 require_once 'conexao_banco.php';
  error_reporting(0);
 //$codClienteAtual = $_SESSION['codClienteAtual'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="">
	<title>Carrinho</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>



 <style>
 body {margin-left: 100px; margin-top: 40px; margin-right: 100px;}
 </style>
<body>

 <div class="container"> 
<nav class="navbar navbar-inverseu">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Dani Viagem</a>
    </div>
	<a class="btn btn-info" href="index.php">Continuar Comprando</a>
	<form action="FinalizarPedido.php" method="post" id="final">
	  <button type="submit" name="finaliza" class="btn btn-primary" />Finalizar Pedido </button>
	  </form><br>	
  </div>
</nav>
 </div>



<div class="container">

  <p>Status do seu pedido: </p> 
  <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" style="width:30%">Pedido em Andamento </div>
	 <div class="progress-bar progress-bar-danger" role="progressbar" style="width:30%">Aguardanto Pagamento </div>
</div>
</div>

				  <?php
			   
		if(isset($_POST['finPag'])){
		if(!$_SESSION['dados']){
		echo"<script> location.replace('carrinho.php'); </script>";	
		}
		}
		  
	    foreach($_SESSION['itens'] as $id => $quantidade){
		 $select = $conexao->prepare("SELECT * FROM produto where codProduto = $id");
         $select->execute();
         $produtos = $select->fetchAll();
		 $total = $quantidade * $produtos[0]['preco_produto'];
		 $totalGeral = $totalGeral +  $total;
				  ?>
				  	 <tr>
				 	<td  class="text-left"><b> Total: </b></td>
					<td>R$<?php echo number_format($totalGeral, 2, ',', '.')?></td>
				 </tr>
				

				 <?php } ?>

		
	</div>
	
</body>
</html>