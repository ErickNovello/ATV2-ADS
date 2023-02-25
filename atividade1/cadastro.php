
<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Obter os dados do formulário
	$nome = $_POST["nome"];
	$idade = $_POST["idade"];
	$profissao = $_POST["profissao"];
	$resumo = $_POST["resumo"];
	$foto = $_FILES["foto"]["name"];

	// Verificar se o arquivo de foto é uma imagem
	$check = getimagesize($_FILES["foto"]["tmp_name"]);
	if($check === false) {
	    die("O arquivo enviado não é uma imagem.");
	}

	// Conectar ao banco de dados
	$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "bios";
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Verificar conexão
	if ($conn->connect_error) {
	    die("Conexão falhou: " . $conn->connect_error);
	}

	// Inserir dados no banco de dados
	$sql = "INSERT INTO usuarios (nome, idade, profissao, resumo, foto) VALUES ('$nome', '$idade', '$profissao', '$resumo', '$foto')";
	if ($conn->query($sql) === TRUE) {
	    $last_id = $conn->insert_id;
	    $target_dir = "uploads/";
	    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
	    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
	    echo "Bio adicionada com sucesso.";
		
        
	} else {
	    echo "Erro ao adicionar bio: " . $conn->error;
	}

    
	// Fechar conexão com o banco de dados
	$conn->close();
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Midgard - Bio adicionada</title>
	<link rel="stylesheet" type="text/css" href="css/style3.css">
</head>
<body>
	<header>
		<div class="logo">Midgard</div>
		<nav>
			<ul>
				<li><a href="index.php">Página Inicial</a></li>
				<li><a href="add_bio.html">Adicionar nova bio</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<div class="container">
			<h1>Bio adicionada com sucesso!</h1>
			<a href="index.php" class="button">Voltar para a Página Inicial</a>
		</div>
	</main>
</body>
</html>