<?php
$cpf = $_GET["cpf"]
$senha = $_GET["senha"]
$page = file_get_contents('http://www.biblioteca.ufpe.br/pergamum/biblioteca_s/php/login_usu.php?login='.$cpf.'&password='.$senha);
if (strpos($page, 'div') !== false) echo '0';
else echo '1';
?>