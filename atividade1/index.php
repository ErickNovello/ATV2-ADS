<!DOCTYPE html>
<html>
<head>
	<title>Midgard</title>
	<link rel="stylesheet" href="css/style2.css">
</head>
<body>
	<header>
		<div class="logo">
			<h1>Midgard</h1>
		</div>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="add_bio.html">Adicionar nova bio</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<h2>Bios dos usuários</h2>
		<table>
			<tr>
				<th>Foto</th>
				<th>Nome</th>
				<th>Idade</th>
				<th>Profissão</th>
				<th>Resumo</th>
			</tr>
			<?php
			// Conectar ao banco de dados
			$servername = "localhost";
			$username = "banco";
			$password = "senhaforte123";
			$dbname = "bios";
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Verificar conexão
			if ($conn->connect_error) {
			    die("Conexão falhou: " . $conn->connect_error);
			}

			// Consultar dados do banco de dados
			$sql = "SELECT * FROM usuarios";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // Exibir dados em uma tabela
			    while($row = $result->fetch_assoc()) {
			        echo "<tr>";
					echo "<td class='foto'><img src='uploads/" . $row["foto"] . "'></td>";
			        echo "<td>" . $row["nome"] . "</td>";
			        echo "<td>" . $row["idade"] . "</td>";
			        echo "<td>" . $row["profissao"] . "</td>";
			        echo "<td>" . $row["resumo"] . "</td>";

			        echo "</tr>";
			    }
			} else {
			    echo "<tr><td colspan='5'>Nenhuma bio encontrada</td></tr>";
			}

			// Fechar conexão com o banco de dados
			$conn->close();
			?>
		</table>
	</main>
</body>
</html>
