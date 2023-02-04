<?php
$senha= 'minha senha';
try {
    $conexao = new PDO("mysql:host=localhost;dbname=nomeDB", "Usuario DB", "$senha");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "<p class=\"bg-danger\">Erro na conexão:" . $erro->getMessage() . "</p>";
	
}



