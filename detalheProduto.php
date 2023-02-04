<?php
session_start();
?>
<?php
error_reporting(0);
require_once 'conexao_banco.php';
 $quantCarrinho =  $_SESSION['quantCarrinho'] ;
 $usuAtual = $_SESSION['cpf_usuario'];
 
    if(isset($_GET['add']) && $_GET['add'] == "detalheProduto"){
	   $id = $_GET['codProduto'];
   }

 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

  <title>Dani Viagem</title>
  <meta charset="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  body {
    font: 400 15px/1.8 Lato, sans-serif;
    color: #777;
  }
  h3, h4 {
    margin: 10px 0 30px 0;
    letter-spacing: 10px;      
    font-size: 20px;
    color: #111;
  }
  .container {
    padding: 80px 120px;
	jmargin-left: 10px;
  }
  
#box:hover{
	border-radius:50%;
	background-image:green;
    transform: scale(1.1);
    color: black;
}


  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">


<?php include "menu.php";?>
			
							
<div class="container">    
<div class="row">
		
		                      <?php
								 $smtp = $conexao->prepare("SELECT * FROM produto where codProduto = $id"); 
								 $smtp->execute();
								 $products= $smtp->fetchAll();
									?>	
		
			<?php foreach($products as $product) { ?>
				 <div id="box" class="col-md-10">
					<div class="panel panel-primary">
						  <div class="panel-heading" ><?php echo $product['nome_produto']?></div>
						  <div class="panel-heading"><?php echo $product['descricao_produto']?></div>
						
							<div class="panel-body"> <?php	echo '<img height="300" width="300" src="'.$product['imagem_produto'].'">';?></div>
						
							  <div class="panel-footer" >R$<?php echo number_format($product['preco_produto'], 2, ',', '.')?></div>
							

							 <a class="btn btn-primary" href="carrinho.php?add=carrinho&codProduto=<?php echo $product['codProduto']?>" class="card-link">Comprar</a>
							 
							 
							
						
						
					</div>
				</div>

			<?php }?>
		</div>
	</div>
	

<footer class="container-fluid text-center">


  
</footer>

</body>
</html>