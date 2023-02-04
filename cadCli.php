<?php
 require_once 'conexao_banco.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $codCliente = filter_input(INPUT_POST, 'codUsuario');
    $nome_cliente = filter_input(INPUT_POST, 'nome_usuario');
    $cpf_cliente = filter_input(INPUT_POST, 'cpf_usuario');
    $email_cliente = filter_input(INPUT_POST, 'email_usuario');
    $telefone_cliente = filter_input(INPUT_POST, 'telefone_usuario');
    $dataNasc_cliente = filter_input(INPUT_POST, 'nascimento_usuario');
    $endereco_cliente = filter_input(INPUT_POST, 'endereco_usuario');
    $cidade_cliente = filter_input(INPUT_POST, 'cidade_usuario');
    $cep_cliente = filter_input(INPUT_POST, 'cep_usuario');
    $estado_cliente = filter_input(INPUT_POST, 'uf_usuario');
	$senha_usuario = filter_input(INPUT_POST, 'senha_usuario');
	$confirma_senha = filter_input(INPUT_POST, 'confirma_senha');
	$redefine_senha_usuario = filter_input(INPUT_POST, 'redefine_senha_usuario');
	
	
	if($senha_usuario === $confirma_senha){
	 //exit;
	// print_r($nome_cliente);
	 echo  "<script>alert($nome_cliente);</script>";
    echo "<script>location.href='Login.html'</script>";
	

} 
 else  {
	 echo  "<script>alert('senhas não compativeis');</script>";
    echo "<script>location.href='cadastroCliente.php'</script>";
	
}
}
  if (!isset($nome_cliente)) {
    $nome_cliente = (isset($_GET["nome_usuario"]) && $_GET["nome_usuario"] != null) ? $_GET["nome_usuario"] : "";
}



if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" ) {
    try {
         $stmt = $conexao->prepare("INSERT INTO usuario (nome_usuario, cpf_usuario, email_usuario, telefone_usuario, nascimento_usuario, endereco_usuario, cidade_usuario, uf_usuario, cep_usuario, senha_usuario,redefine_senha_usuario ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
        $stmt->bindParam(1, $nome_cliente);
        $stmt->bindParam(2, $cpf_cliente);
        $stmt->bindParam(3, $email_cliente);
        $stmt->bindParam(4, $telefone_cliente);
        $stmt->bindParam(5, $dataNasc_cliente);
        $stmt->bindParam(6, $endereco_cliente);
        $stmt->bindParam(7, $cidade_cliente);
        $stmt->bindParam(8, $cep_cliente);
        $stmt->bindParam(9, $estado_cliente);
		$stmt->bindParam(10, $senha_usuario);
		$stmt->bindParam(11, $redefine_senha_usuario);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<p class=\"bg-success\">Dados cadastrados com sucesso!</p>";
                $codCliente = null;
                $nome_cliente = null;
                $cpf_cliente = null;
                $email_cliente = null;
                $telefone_cliente = null;
                $dataNasc_cliente = null;
                $endereco_cliente = null;
                $cidade_cliente = null;
                $cep_cliente = null;
                $estado_cliente = null;
				$senha_usuario = null;
				$redefine_senha_usuario = null;
            } else {
                echo "<p class=\"bg-danger\">Erro ao tentar efetivar cadastro</p>";
            }
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</p>";
    }
}













?>
