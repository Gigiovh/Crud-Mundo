<?php include("../conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cidades</title>
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
      <a href="../pais/listar.php">Países</a>
      <ul>
        <li><a href="../pais/adicionar.php">Adicionar</a></li>
       
      </ul>
    </li>
    <li>
      <a href="listar_cidade.php">Cidades</a>
      <ul>
        <li><a href="adicionar_cidade.php">Adicionar</a></li>
        
      </ul>
  </ul>
</nav>
<h1>Lista de Cidades</h1>

<table>
<tr>
    <th>ID</th><th>Nome</th><th>População</th><th>País</th><th>Ações</th>
</tr>
<?php
$sql = "SELECT c.id_cidade, c.nome AS cidade, c.populacao, p.nome AS pais 
        FROM tb_cidade c 
        JOIN tb_pais p ON c.id_pais = p.id_pais
        ORDER BY p.nome, c.nome";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id_cidade']}</td>
            <td>{$row['cidade']}</td>
            <td>{$row['populacao']}</td>
            <td>{$row['pais']}</td>
            <td>
                <a href='editar_cidade.php?id={$row['id_cidade']}'>Editar</a> |
                <a href='excluir_cidade.php?id={$row['id_cidade']}' onclick='return confirm(\"Deseja excluir esta cidade?\")'><span style='color:red;'>Excluir</span></a>
            </td>
          </tr>";
}
?>
</table>
</body>
</html>
