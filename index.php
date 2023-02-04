<?php
session_start();
?>
<?php
 error_reporting(0);
require_once 'conexao_banco.php';
 $quantCarrinho =  $_SESSION['quantCarrinho'] ;
 $usuAtual = $_SESSION['cpf_usuario'];
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
#inp {  margin-left:25px;  margin-right:25px;}


  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<?php include "menu.php"; ?>



 <form action="paginaPesquisa.php" method="GET" class="form-group input-group" id="inp">
 <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
<input name="pesqProduto" id="pesqProduto" placeholder="Busca Produto" type="text" class="form-control">
</form>


			
							
<div class="container" >    
<div class="row" id="ct">
		
		                      <?php
								 $smtp = $conexao->prepare("SELECT * FROM produto where destaque = 1"); 
								 $smtp->execute();
								 $products= $smtp->fetchAll();
									?>	
		
			<?php foreach($products as $product) { ?>
				 <div class="col-md-4" >
					<div class="panel panel-primary">
						  <div class="panel-heading"><?php echo $product['nome_produto']?></div>
						
							<div class="panel-body"> <?php	echo '<img height="230" width="230" src="'.$product['imagem_produto'].'">';?></div>
						
							  <div class="panel-footer" >R$<?php echo number_format($product['preco_produto'], 2, ',', '.')?></div>
							

							 <a class="btn btn-primary" href="carrinho.php?add=carrinho&codProduto=<?php echo $product['codProduto']?>" class="card-link">Comprar</a>
							 <a class="btn btn-primary" href="detalheProduto.php?add=detalheProduto&codProduto=<?php echo $product['codProduto']?>" class="card-link">Mais informações</a>
							 
							
						
						
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
      <p><span class="glyphicon glyphicon-map-marker"></span> Canoas, RS</p>
      <p><span class="glyphicon glyphicon-phone"></span> Telefone: 51 3477-9999</p>
      <p><span class="glyphicon glyphicon-envelope"></span> Email: daniViagem@daniViagem.com.br</p>
    </div>
    <div class="col-md-8">
      <div class="row">
          <form  class="form" action="formContato.php" method="post">
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
           </form >
        </div>
      </div>
    </div>
  </div>
  <br>
  
  
</footer>

</body>
</html>