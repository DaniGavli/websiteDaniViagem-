<?php
session_start();
?>
<?php
ob_start();
include "fatura.php";
$conteudo = ob_get_contents();
ob_end_clean();
?>
<?php
$para = 'Email configurado aqui';
$assunto = 'fatura';

//mail();
$envio = mail($para,$assunto,$conteudo,"Content-type: text/html\r\n");
if($envio)
echo  "<script>alert('Fatura enviada para o email cadastrado!');</script>";
echo "<script>location.href='index.php'</script>";
?>

