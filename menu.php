
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="https://aulawebsemantica1506.000webhostapp.com">Dani Viagem</a>
    </div>
	
    <ul class="nav navbar-nav">

      <li class="active"><a href="https://aulawebsemantica1506.000webhostapp.com/">Home</a></li>
	  <?php
	  	$smtp = $conexao->prepare("Select * from categoria "); 
		$smtp->execute();
		$categoria= $smtp->fetchAll();
		
        foreach($categoria as $row) {
            $cat=$row["idCategoria"];
       
				?>
				<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $row['categoria']; ?><span class="caret"></span></a>
          
		  
		
			<ul class="dropdown-menu">
		
	    <?php
	    $smtp = $conexao->prepare("Select * from subcategoria WHERE idCategoria = $cat "); 
		$smtp->execute();
		$categoria= $smtp->fetchAll();
		foreach($categoria as $row) {
        $subcat=$row["idSubcategoria"];
		?>
		<a href="#"><?php echo $row['subcategoria']; ?></a>
			
		<?php	
		$smtp = $conexao->prepare("Select * from produto WHERE idSubcategoria = $subcat "); 
		$smtp->execute();
		$categoria= $smtp->fetchAll();
		foreach($categoria as $row) {
			?>
			 <li>
			<a href="<?php echo $row['link']; ?>"><?php echo $row['nome_produto']; ?></a>
			</li>
	<?php } ?>
		</li>
		<?php } ?>

			
			</ul>
			<?php } ?>
			<li><a href="#">Galeria e Feddback</a></li> 
			<li><a href="#contato">Contato</a></li>  
          </ul>
		  
		         
    <ul class="nav navbar-nav navbar-right">
	   <li><a href="carrinho.php" class="btn btn-secondary"><span class="glyphicon glyphicon-shopping-cart"  class="badge badge-light" ><?php echo ' ' .  $quantCarrinho ?> </span></a></li>
	  <?php if($usuAtual){ ?>
      <li><a href="sair.php"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
	  
	<?php  } else { ?>
      <li><a href="cadastroCliente.php"><span class="glyphicon glyphicon-user"></span> Sou novo aqui </a></li>
      <li><a href="Login.html"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	  	<?php } ?>
    </ul>
  </div>
</nav>