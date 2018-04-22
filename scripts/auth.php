<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../styles/default_style.css">
    <title>RALB</title>
</head>
<body>
<div class="content">
    <?php
	$cpf = $_GET["cpf"];
	$senha = $_GET["senha"];
	$page = file_get_contents('http://www.biblioteca.ufpe.br/pergamum/biblioteca_s/php/login_usu.php?login='.$cpf.'&password='.$senha);
	if (strpos($page, 'div') !== false) echo 'Dados inválidos, tente novamente.';
	else echo 'Cadastro concluído com sucesso!';
	?>
	<br>
	<form action="../index.html">
    	<input type="submit" value="Voltar" />
	</form>
</div>
</body>
</html>



