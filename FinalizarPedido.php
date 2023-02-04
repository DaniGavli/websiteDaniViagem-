<?php
session_start();
?>
<?php
 error_reporting(0);
 require_once 'conexao_banco.php';
 $usuAtual = $_SESSION['codUsuario'];

 ?>
  <!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="">
	<title>Pedidos</title>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
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
	<a href="index.php" ><button class="btn btn-primary" >Voltar para a pagina Inicial </button></a>
	 <a href="fatura.php" target="_blank" ><button class="btn btn-warning" >Visualizar Fatura </button></a>

  </div>
</nav>
 </div>

	
	
	<div class="container">

  <p>Status do seu pedido: </p> 
  <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" style="width:25%" >Pedido em Andamento </div>
	 <div class="progress-bar progress-bar-success" role="progressbar" style="width:25%">Pagamento Aprovado </div>
	 <div class="progress-bar progress-bar-success" role="progressbar" style="width:25%">Pedido em separação para envio </div>
	  <div  class="progress-bar progress-bar-danger" role="progressbar" style="width:25%">Pedido Entregue</div>
</div>

</div>

<?php

       
	if(isset($_POST['finaliza'])){
		if($_SESSION['codUsuario']==null){
		    
			 echo"<script> location.replace('Login.html'); </script>";
		}
		
		
		  $select = $conexao->prepare("select codPedido FROM pedidos ORDER BY codPedido DESC LIMIT 1");
          $select->execute();
		  $ultimoPedido = $select->fetch();
		  $ultimoPedido =$ultimoPedido[0] + 1;
		  $_SESSION['pedidoAtual'] = $ultimoPedido;
		 
 

    foreach ($_SESSION['dados'] as $item) {
     $insert = $conexao->prepare ("INSERT INTO vendas (idVenda, codProduto, valor_unitario, quantidade_venda) VALUES (?,?,?,?)");
	 $insert->bindParam(1, $ultimoPedido);
     $insert->bindParam(2, $item['codProduto']);
	 $insert->bindParam(3, $item['preco_produto']);
	 $insert->bindParam(4, $item['quantidade_pedido']);
	 $totGeral = $totGeral + $item['total_geral'];
          $insert->execute();
}


    foreach($_SESSION['dados'] as $produtos){
		$estoqueAtual= $produtos['Estoque'];
		$quantPedido = $produtos['quantidade_pedido'];
		$atualiza = $estoqueAtual - $quantPedido;
    if($atualiza <=0){
        unset($produtos);
		 echo  "<script>alert('Estoque Indisponivel');</script>";
		 echo"<script> location.replace('carrinho.php'); </script>";
		 
		 exit;
		 
	}else if($atualiza > 0){
	  $prodUpdate = $produtos['codProduto'];

		 $stmt = $conexao->prepare("UPDATE produto SET estoque_produto = $atualiza WHERE codProduto = $prodUpdate");
          $stmt->execute();
	echo  "<script>alert('Compra realizada com sucesso!');</script>";
   echo"<script> location.replace('envioFatura.php'); </script>";
		
			
	  }
 }
 

	 $insert = $conexao->prepare("INSERT INTO pedidos (idVenda, codUsuario, total_pedido) VALUES (?,?,?)");
	 $insert->bindParam(1,$ultimoPedido);
	 $insert->bindParam(2, $usuAtual);
	 $insert->bindParam(3, $totGeral);
	 $insert->execute();
	 unset($_SESSION['dados']);
	 unset($_SESSION['itens']);
	 
			?>
  
	
	<div class="row" id="tbl">
                    <div class="panel panel-default">
                        <table class="table table-striped">
                            <thead>
							
							 <tr>
                                     
                                   
									 <th>ID Pedido</th>
                                    <th>Produto</th>
                                    <th>Data Venda</th>
									 <th>Valor unitario</th>
									  <th>quantidade</th>
									  <th>Cliente</th>
									  <th>CPF Cliente</th>
									 <th>Total</th>
                                   
                                   
                                   
                                </tr>
                            </thead>
                            <tbody>		

                              <?php
		
               $smtp = $conexao->prepare("SELECT v.codVenda, pd.codPedido, v.valor_unitario, l.codUsuario, pr.nome_produto, v.quantidade_venda, pd.data_Pedido, l.nome_usuario, l.cpf_usuario, pd.total_pedido
               FROM vendas v 
              INNER JOIN pedidos pd ON (v.idVenda = pd.idVenda) 
			  INNER JOIN produto pr ON (pr.codProduto = v.codProduto) 
			  INNER JOIN usuario l ON (pd.codUsuario = l.codUsuario) 
			  where v.idVenda = $ultimoPedido");
								 $smtp->execute();
								 $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);?>	
							<?php if(count($rs)){
								
						          foreach($rs as $rs){
							
                                            ?><tr>
											  <td><?php echo $rs['codPedido']; ?></td>
											   <td><?php echo $rs['nome_produto']; ?></td>
											    <td><?php echo $rs['data_Pedido']; ?></td>
                                                <td><?php echo number_format ($rs['valor_unitario'], 2, ',', '.'); ?></td>
                                                <td><?php echo $rs['quantidade_venda']; ?></td>
                                                <td><?php echo $rs['nome_usuario']; ?></td>
                                                <td><?php echo $rs['cpf_usuario']; ?></td>
												<td><?php echo number_format ($rs['total_pedido'], 2, ',', '.'); ?></td>
												
                                                <td><center>  
                                        </center>
                                        </td>
                                        </tr>
                                        
                                        <?php
					}} 

					?>

                            </tbody>
                        </table>
                       
                        
                       
				 	<br><td  colspan="4" class="text-right"><b>Total: </b></td>
					<td>R$  <?php echo number_format ($rs['total_pedido'], 2, ',', '.'); ?></td>
                        
                    </div>
					</div>

			<?php } ?>



	
	</body>
	</html>			
			
	