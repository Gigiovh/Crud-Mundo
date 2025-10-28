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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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

<!-- Listagem de países -->

<h1 style="  margin-top: 100px;">Lista de Países</h1>
<table>
<tr>
  <th>ID</th><th>Nome</th><th>Continente</th><th>População</th><th>Idioma</th><th>Informações Extras</th><th>Ações</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM tb_pais ORDER BY nome");

while ($row = $result->fetch_assoc()) {
    // --- API REST COUNTRIES ---
    $paisNome = urlencode($row['nome']);
    $apiUrl = "https://restcountries.com/v3.1/name/$paisNome?fullText=true";
    
    $bandeira = $capital = $moeda = "—";

    $apiData = @file_get_contents($apiUrl);
    if ($apiData !== false) {
        $dados = json_decode($apiData, true);
        if (is_array($dados) && isset($dados[0])) {
            $paisData = $dados[0];
            $bandeira = isset($paisData['flags']['png']) ? "<img src='" . htmlspecialchars($paisData['flags']['png'], ENT_QUOTES) . "' width='40'>" : "—";
            $capital = $paisData['capital'][0] ?? 'N/A';
            $moeda = isset($paisData['currencies']) ? implode(', ', array_keys($paisData['currencies'])) : '—';
        }
    }
    // --------------------------

    echo "<tr>
            <td>{$row['id_pais']}</td>
            <td>{$row['nome']}</td>
            <td>{$row['continente']}</td>
            <td>{$row['populacao']}</td>
            <td>{$row['idioma']}</td>
            <td>
                $bandeira<br>
                <strong>Capital:</strong> $capital<br>
                <strong>Moeda:</strong> $moeda
            </td>
            <td>
                <a href='editar.php?id={$row['id_pais']}'>Editar</a> |
                <a href='excluir.php?id={$row['id_pais']}' onclick='return confirm(\"Tem certeza?\")'>
                    <span style='color:red;'>Excluir</span>
                </a>
            </td>
          </tr>";
}
?>
</table>

<!-- Footer -->
<footer class="footer">
  <h2 class="footer-logo">Clement's World</h2>


  <div class="footer-social">
    <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
    <a href="https://github.com/Gigiovh" target="_blank"><i class="fab fa-github"></i></a>
    <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
  </div>

  <p class="footer-copy">
    Clement's World ©2025 Todos os direitos reservados a <a href="https://github.com/Gigiovh">Gigiovh</a>
    <span class="heart">★</span> 
  </p>
</footer>
</body>
</html>
