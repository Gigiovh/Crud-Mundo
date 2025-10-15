<?php include("../conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Países</title>
<link rel="stylesheet" href="../style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
     
<nav class="test">
  <ul>
    <li><a href="../index.php">Home</a></li>
    <li>
      <a href="listar.php">Países</a>
      <ul>
        <li><a href="adicionar.php">Adicionar</a></li>
       
      </ul>
    </li>
    <li>
      <a href="../cidade/listar_cidade.php">Cidades</a>
      <ul>
        <li><a href="../cidade/adicionar_cidade.php">Adicionar</a></li>
        
      </ul>
  </ul>
</nav>
<h1>Lista de Países</h1>
<table>
<tr>
<th>ID</th><th>Nome</th><th>Continente</th><th>População</th><th>Idioma</th><th>Ações</th>
</tr>
<?php
$result = $conn->query("SELECT * FROM tb_pais ORDER BY nome");
while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id_pais']}</td>
            <td>{$row['nome']}</td>
            <td>{$row['continente']}</td>
            <td>{$row['populacao']}</td>
            <td>{$row['idioma']}</td>
            <td>
                <a href='editar.php?id={$row['id_pais']}'>Editar</a> |
                <a href='excluir.php?id={$row['id_pais']}' onclick='return confirm(\"Tem certeza?\")'><span <span style='color:red;'>Excluir</span></a>
            </td>
        </tr>";
}
?>
</table>
</body>
</html>
