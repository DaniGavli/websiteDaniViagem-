<?php
session_start();
?>
<?php
require_once 'conexao_banco.php';
 error_reporting(0);

  if(!isset($_SESSION['itens'])){
	  $_SESSION['itens'] = array();
	  
  }
   if(isset($_GET['add']) && $_GET['add'] == "carrinho"){
	   //add ao carrinho
	   $id = $_GET['codProduto'];
	    //print_r($_GET['codProduto']);
	   if(!isset($_SESSION['itens'][$id])){
		    $_SESSION['itens'][$id] = 1;
	   }else{
			$_SESSION['itens'][$id] += 1;
		}
   }
      
	?>  
	
	<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Carrinho</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


 <style>
 body {margin-left: 100px; margin-top: 40px; margin-right: 100px;}

 </style>
 </head>
<body>

 <div class="container"> 
 
<nav class="navbar navbar-inverseu">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Dani Viagem</a>
    </div>
 
	<a class="btn btn-info" href="index.php">Continuar Comprando</a>  
	<form action="pagamento.php" method="post" name="finPag" >
	 <button type="submit" name="finPag" class="btn btn-primary" />Finalizar Pedido </button>
	 </form>
  </div>
</nav>
 </div>


<div class="container">
  <p>Status do seu pedido: </p> 
  <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" style="width:30%">
Pedido em Andamento 
  </div>
</div>

	


	<div class="container">
		<div class="">
			 <div class="card-body">
	    		<a href="index.php">Lista de Produtos</a>
	    	</div>
		</div>

		<?php
		if(count($_SESSION['itens']) == 0 ){
			//echo 'Carrinho vazio <br><a href="selectProd.php">Adicionar Itens</a>';
			?>
	   
	   <label>Carrinho Vazio -> <a href="index.php"> Adicionar Itens</a></label><br>
	<?php	
	}else{ 
	
	  
		$_SESSION['dados'] = array();
		
		
	?>

			<table class="table table-strip">
				<thead>
					<tr>
						<th>Produto</th>
						<th>Descrição</th>
						<th>Quantidade</th>
						<th>Preço</th>
						<th>Subtotal</th>
						<th>Adicionar</th>
						<th>Remover</th>
 
					</tr>				
				</thead>
				<tbody>
				
				
				
				  <?php
				  foreach($_SESSION['itens'] as $id => $quantidade){
		
		  $select = $conexao->prepare("SELECT * FROM produto where codProduto = $id");
          $select->execute();
          $produtos = $select->fetchAll();
		  $total = $quantidade * $produtos[0]['preco_produto']; 
		  $totalGeral = $totalGeral +  $total;
		  $quantCarrinho = $quantCarrinho + $quantidade;
		  $_SESSION['quantCarrinho']= $quantCarrinho;
		 
		     $produtos[0]['nome_produto'].'<br/>
			Categoria: '.$produtos[0]['categoria_produto'].'<br/>
			Descricao: '.$produtos[0]['descricao_produto'].'<br/>
		
			Estoque: '.$produtos[0]['estoque_produto'].'<br/>
			  Preco Unitario: '.number_format($produtos[0]['preco_produto'],2,",","."). '<br/>
			  Quantidade: '.$quantidade. '<br/>
			  Preco Total: '.number_format($total,2,",","."). '<br/>
			  total Geral: '.number_format($totalGeral,2,",","."). '<br/>
			 
			  //<a href="removeProd.php?removeProd=carrinho&codProduto='.$id.'">Deleta</a>
			  
			  <hr/>
			  ';
			

			  array_push(
			  $_SESSION['dados'], 
			  array(
			 
			 'quantidade_pedido' => $quantidade,
			   'preco_produto' => $produtos[0]['preco_produto'], 
			   'codProduto' => $id,
				'val_pedido' => $total,
				'Estoque'=>$produtos[0]['estoque_produto'],
		        'total_geral'=>$totalGeral
			
			  )
			  );
			  
	  
				  ?>
					<tr>
						
						<td><?php echo  $produtos[0]['nome_produto']?></td>
						<td><?php echo  $produtos[0]['descricao_produto']?></td>
						<td><?php echo $quantidade ?></td>
						<td>R$<?php echo number_format($produtos[0]['preco_produto'], 2, ',', '.')?></td>
						<td>R$<?php echo number_format($total, 2, ',', '.')?></td>
					    <td><a href="removeProd.php?addProd=carrinho&codProduto=<?php echo $produtos[0]['codProduto'] ?>" class="btn btn-success"> + </a></td>
						<td><a href="removeProd.php?removeProd=carrinho&codProduto=<?php echo $produtos[0]['codProduto'] ?>" class="btn btn-danger"> - </a></td>
						
					
					</tr>
				
				 <?php } 
				
		  
				 ?>
				 <tr>
				 	<td colspan="3" class="text-right"><b>Total: </b></td>
					<td> R$ <?php echo number_format($totalGeral, 2, ',', '.')?></td>
				 	
				 	<td></td>
				 </tr>
				
				</tbody>
				
			</table>
	<?php } 
	


		
			
			?>
		
			<?php
		

	?>
	      
			
           
			

		
	</div>
	
</body>
</html>