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
	$option = $_GET["option"];
	if($option == 'cad')
	{
		$page = file_get_contents('http://www.biblioteca.ufpe.br/pergamum/biblioteca_s/php/login_usu.php?login='.$cpf.'&password='.$senha);	
		if (strpos($page, 'div') !== false) echo 'Dados não cadastrados no Pergamum. Verifique se você digitou corretamente e tente novamente.';
		else
		{
			$servername = "localhost";
			$username = "web";
			$password = "";
			$conn = new mysqli($servername, $username, $password);
			if ($conn->connect_error)
			{
				die("Ocorreu um erro na conexão com o servidor. Por favor tente mais tarde. Se o problema persistir contate o criador do sistema");
			}

			$sql = "USE RALB";
			if ($conn->query($sql) !== TRUE)
			{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$sql = "INSERT INTO Users VALUES('".$cpf."', '".$senha."')";
			if ($conn->query($sql) === TRUE)
			{
				echo "Cadastro concluído com sucesso!";
			}
			elseif(mysqli_errno($conn) == 1062)
			{
				echo "Esse CPF já foi cadastrado.";
			}
			else
			{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
			$conn->close();
		}
	}
	elseif($option == 'dcad')
	{
		$servername = "localhost";
		$username = "web";
		$password = "";
		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error)
		{
			die("Ocorreu um erro na conexão com o servidor. Por favor tente mais tarde. Se o problema persistir contate o criador do sistema");
		}

		$sql = "USE RALB";
		if ($conn->query($sql) !== TRUE)
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$sql = "DELETE FROM Users WHERE CPF='".$cpf."'";
		if ($conn->query($sql) === TRUE)
		{
			if(mysqli_affected_rows($conn) <= 0)
			{
				echo 'Os dados inseridos não estão cadastrados. Por favor, tente novamente.';
			}
			else
			{
				echo 'Descadastro concluído com sucesso!';
			}
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();		
	}
	else
	{
		echo "Opção ".$option." desconhecida. Retorne a página anterior e tente de novo.";
	}
	?>
	<br>
	<form action="../index.html">
    	<input type="submit" value="Voltar" />
	</form>
</div>
</body>
</html>



