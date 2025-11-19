<?php 
include("../conexao.php");

define('OPENWEATHER_API_KEY', '06cb432fb3eed4d1136c5929460bd323');

function obterClimaPorCidade($cidadeNome, $paisNome, $apiKey) {
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($cidadeNome) . "," . urlencode($paisNome) . "&appid=" . $apiKey . "&units=metric&lang=pt_br";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $resp = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($resp && $httpCode === 200) {
        return json_decode($resp, true);
    }
    
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($cidadeNome) . "&appid=" . $apiKey . "&units=metric&lang=pt_br";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $resp = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($resp && $httpCode === 200) {
        return json_decode($resp, true);
    }
    
    return null;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cidades</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
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
                <li><a href="estatistica.php">Estatistica</a></li>
        </ul>
    </nav>

    <!-- Listagem de cidades -->
    <h1 style="  margin-top: 100px;">Lista de Cidades</h1>


    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>População</th>
            <th>País</th>
            <th>Clima</th>
            <th>Ações</th>
        </tr>
        <?php
$sql = "SELECT c.id_cidade, c.nome AS cidade, c.populacao, p.nome AS pais 
        FROM tb_cidade c 
        JOIN tb_pais p ON c.id_pais = p.id_pais
        ORDER BY p.nome, c.nome";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $clima = "—";
    
    // Buscar dados do clima para cada cidade
    $dadosClima = obterClimaPorCidade($row['cidade'], $row['pais'], OPENWEATHER_API_KEY);
    
    if ($dadosClima && isset($dadosClima['weather'][0]['description'])) {
        $descricao = ucfirst($dadosClima['weather'][0]['description']);
        $temperatura = round($dadosClima['main']['temp']);
        $clima = $descricao . ", " . $temperatura . "°C";
    } elseif ($dadosClima && isset($dadosClima['message'])) {
        $clima = "Cidade não encontrada";
    }

    echo "<tr>
            <td>{$row['id_cidade']}</td>
            <td>{$row['cidade']}</td>
            <td>{$row['populacao']}</td>
            <td>{$row['pais']}</td>
            <td>$clima</td>
            <td>
                <a href='editar_cidade.php?id={$row['id_cidade']}'>Editar</a> |
                <a href='excluir_cidade.php?id={$row['id_cidade']}' onclick='return confirm(\"Deseja excluir esta cidade?\")'><span style=\"color:red;\">Excluir</span></a>
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
