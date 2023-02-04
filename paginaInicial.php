<?php

session_start();
require_once 'conexao_banco.php';
 $quantCarrinho =  $_SESSION['quantCarrinho'] ;
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Dani Viagem</title>
  <meta charset="utf-8">
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


  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Dani Viagem</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Nossos Produtos</a></li> 
	<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Itens Personalizados
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Carteiras em Couro</a></li>
            <li><a href="#">Capa para Celular</a></li>
			</ul>
			<li><a href="#">Galeria e Feddback</a></li>
	        <li><a href="#">Promoções</a></li>  
			<li><a href="#contato">Contato</a></li>  
          </ul>
		  
		         
    <ul class="nav navbar-nav navbar-right">
	   <li><a href="carrinho.php" class="btn btn-secondary"><span class="glyphicon glyphicon-shopping-cart"  class="badge badge-light" ><?php echo ' ' .  $quantCarrinho ?> </span></a></li>
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sou novo aqui </a></li>
      <li><a href="Login.html"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>


 <form action="paginaPesquisa.php" method="GET" class="form-group input-group">
 <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
<input name="pesqProduto" id="pesqProduto" placeholder="Busca Produto" type="text" class="form-control">
</form>


			
							
<div class="container">    
<div class="row">
		
		                      <?php
								 $smtp = $conexao->prepare("SELECT * FROM produto where destaque = 1"); 
								 $smtp->execute();
								 $products= $smtp->fetchAll();
									?>	
		
			<?php foreach($products as $product) { ?>
				 <div class="col-md-4">
					<div class="panel panel-primary">
						  <div class="panel-heading"><?php echo $product['nome_produto']?></div>
						
							<div class="panel-body"> <?php	echo '<img height="230" width="230" src="'.$product['imagem_produto'].'">';?></div>
						
							  <div class="panel-footer" >R$<?php echo number_format($product['preco_produto'], 2, ',', '.')?></div>
							

							 <a class="btn btn-primary" href="carrinho.php?add=carrinho&codProduto=<?php echo $product['codProduto']?>" class="card-link">Comprar</a>
							
						
						
					</div>
				</div>

			<?php }?>
		</div>
	</div>
	
	
	
	
	
	


<footer class="container-fluid text-center">

<div id="contato" class="container">
  <h3 class="text-center">Contato</h3>
  <p class="text-center"><em>Deixe a sua mensagem aqui!</em></p>

  <div class="row">
    <div class="col-md-4">
      <p>Estamos Aqui:</p>
      <p><span class="glyphicon glyphicon-map-marker"></span>Canoas, RS</p>
      <p><span class="glyphicon glyphicon-phone"></span>Telefone: 51 3477-9999</p>
      <p><span class="glyphicon glyphicon-envelope"></span>Email: daniViagem@daniViagem.com.br</p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="nome" name="nome" placeholder="Nome" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="mensagem" name="mensagem" placeholder="Mensagem" rows="5"></textarea>
      <br>
      <div class="row">
        <div class="col-md-12 form-group">
          <button class="btn pull-right" type="submit">Enviar</button>
        </div>
      </div>
    </div>
  </div>
  <br>
  <hr>
  
  <p>Receba nossas ofertas e novidades</p>  
  <form class="form-inline">
    <input type="email" class="form-control" size="50" placeholder="Seu Email aqui">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>
</html>