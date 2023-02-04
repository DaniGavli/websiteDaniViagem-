
<?php

$nomeremetente = $_POST['nome'];
$emailremetente = trim($_POST['email']);
$emaildestinatario = 'email aqui...';

$assunto = 'Email de contato site Dani Viagem';
$mensagem = $_POST['mensagem'];

$mensagemHTML = $assunto;


$corpoEmail = $mensagem . $emailremetente;
// return-path
$envio = mail($emaildestinatario, $mensagemHTML, $corpoEmail);
if($envio)
echo  "<script>alert('Recebemos a mensagem, aguarde o retorno em até 24 horas!');</script>";
echo "<script>location.href='index.php'</script>";
?>
 