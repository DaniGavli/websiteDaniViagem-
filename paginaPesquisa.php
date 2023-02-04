<?php
session_start();
?>
<?php
require_once 'conexao_banco.php';
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
  #ItemPesquisado{margin-left: 200px;}

  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">


<?php include "menu.php"; ?>

 <form action="paginaPesquisa.php" method="GET" class="form-group input-group">
 <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
<input name="pesqProduto" id="pesqProduto" placeholder="Busca Produto" type="text" class="form-control">
</form>


	
	<?php
                     if(!isset($_GET['pesqProduto'])){
									//header("Location: consulta.php"); 
									 exit;
								 }else{
								 // try {
								
								 $pesqProduto = "%".trim($_GET['pesqProduto'])."%";
								 $smtp = $conexao->prepare("SELECT * FROM `produto` where `nome_produto` like :pesqProduto");
                                 $smtp->bindValue(':pesqProduto', $pesqProduto, PDO::PARAM_STR);
								 $smtp->execute();
								 $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);
							
									?>	
							 
							 
							 
							 <div class="container">    
                             <div class="row">
			<?php
			 if(count($rs)){
				
				?> 
				<a href="#ItemPesquisado"></a>
				<div class="alert alert-success" role="alert"> Produto localizado </div>
				 <?php
			foreach($rs as $rs) { ?>
				 <div class="col-md-5" id="ItemPesquisado">
					<div class="panel panel-success">
						  <div class="panel-heading"><?php echo $rs['nome_produto']?></div>
						
							<div class="panel-body"> <?php	echo '<img height="230" width="230" src="'.$rs['imagem_produto'].'">';?></div>
						
							  <div class="panel-footer" >R$<?php echo number_format($rs['preco_produto'], 2, ',', '.')?></div>
							

							 <a class="btn btn-primary" href="carrinho.php?add=carrinho&codProduto=<?php echo $rs['codProduto']?>" class="card-link">Comprar</a>
							 <a class="btn btn-primary" href="detalheProduto.php?add=detalheProduto&codProduto=<?php echo $rs['codProduto']?>" class="card-link">Mais informações</a>
						
						
					</div>
				</div>

				<?php }
				}else{ 
				?>
				<div class="alert alert-secondary" role="alert"> Não encontramos o item pesquisado </div>
                  <?php } ?>
		</div>
	</div>
			<?php } ?>				
							
							
							
				
	


<footer class="container-fluid text-center">

</footer>

</body>
</html>