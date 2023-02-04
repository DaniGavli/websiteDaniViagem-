<?php
session_start();
 ?>
 <?php
 require_once 'conexao_banco.php';
 //$codClienteAtual = $_SESSION['codClienteAtual'];

 
 ?>
  <!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Pedidos</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<style>
 body {margin-left: 100px; margin-top: 40px; margin-right: 100px;}
 
 h11 {
    color:red;
}

#logo {
        width:50%;
        height:50%;
}

.panel-heading{
    font-size:150%;
}

</style>
<body>

<form action="cadCli.php?act=save" method="POST" class="form-horizontal">
<fieldset>
<div class="panel panel-primary">
    <div class="panel-heading">Cadastro de Cliente</div>
    
    <div class="panel-body">
<div class="form-group">

<div class="col-md-11 control-label">
        <p class="help-block"><h11>*</h11> Campo Obrigatório </p>
</div>
</div>


<div class="form-group">
 <input type="hidden" name="codUsuario" value="" />
  <label class="col-md-2 control-label" for="Nome">Nome <h11>*</h11></label>  
  <div class="col-md-8">
  <input id="Nome" name="nome_usuario" placeholder="" class="form-control input-md" required="" type="text">
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label" for="cpf">CPF <h11>*</h11></label>  
  <div class="col-md-2">
  <input id="cpf" name="cpf_usuario" placeholder="Apenas números" class="form-control input-md" required="" type="text" maxlength="11" pattern="[0-9]+$">
  </div>
  
  <label class="col-md-1 control-label" for="Nome">Nascimento<h11>*</h11></label>  
  <div class="col-md-2">
  <input id="dtnasc" name="nascimento_usuario" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="date" maxlength="10"  onBlur="showhide()">
</div>


<div class="form-group">
  <label class="col-md-1 control-label" for="prependedtext">Telefone <h11>*</h11></label>
  <div class="col-md-2">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
      <input id="prependedtext" name="telefone_usuario" class="form-control" placeholder="XX XXXXX-XXXX" required="" type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$">
    </div>
  </div>
 </div> 

<!-- Prepended text  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"-->
<div class="form-group">
  <label class="col-md-2 control-label" for="prependedtext">Email <h11>*</h11></label>
  <div class="col-md-5">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      <input id="prependedtext" name="email_usuario" class="form-control" placeholder="email@email.com" required="" type="text"  >
    </div>
  </div>
</div>


<!-- Search input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="CEP">CEP <h11>*</h11></label>
  <div class="col-md-2">
    <input id="cep" name="cep_usuario" placeholder="Apenas números" class="form-control input-md" required="" value="" type="search" maxlength="8" pattern="[0-9]+$">
  </div>
  


<!-- Prepended text-->
<div class="form-group">
  <label class="col-md-2 control-label" for="prependedtext">Endereço <h11>*</h11></label>
  <div class="col-md-4">
      <input  name="endereco_usuario" class="form-control" placeholder="" required="" type="text">
    </div>   
  </div>
   </div>
<div class="form-group">
  <label class="col-md-2 control-label" for="prependedtext">Cidade <h11>*</h11></label>
  <div class="col-md-2">
      <input id="cidade" name="cidade_usuario" class="form-control" placeholder="" required="" type="text">
    </div>

  
  <div class="form-group">
  <label class="col-md-2 control-label" for="prependedtext">UF <h11>*</h11></label>
  <div class="col-md-1">
      <input name="uf_usuario" class="form-control" placeholder="" required="" type="text">
    </div>
  </div> 
    </div> 
	<hr>
	
	<div class="form-group">
  <label class="col-md-4 control-label" for="prependedtext"> Informe uma Senha de acesso</label>
  <div class="col-md-3">
      <input  name="senha_usuario" class="form-control" placeholder="" required="" type="password">
    </div>
  </div> 
   
	
	<div class="form-group">
  <label class="col-md-4 control-label" for="prependedtext"> Repita a Senha</label>
  <div class="col-md-3">
      <input  name="confirma_senha" class="form-control" placeholder="" required="" type="password">
    </div>
  </div> 
  
  <div class="form-group">
  <label class="col-md-4 control-label" for="prependedtext"> Informe uma chave para Recuperação de senha</label>
  <div class="col-md-3">
      <input  name="redefine_senha_usuario" class="form-control" placeholder="" required="" type="text">
    </div>
  </div> 
   
  </div>
</div>


    <div class="panel-footer">
      <div class="clearfix">
      <div class="pull-right">
            <button type="submit" class="btn btn-primary" /><span class="glyphicon glyphicon-ok"></span> salvar</button>
        </div>
         </div>
         </div>


 
</fieldset>
</form>

    </body>
	</html>			
	