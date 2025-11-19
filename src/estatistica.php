<?php 
include("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cidades</title>
    <link rel="stylesheet" href="style.css">
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

    <!-- Listagem de estatistica -->
    <h1 style="  margin-top: 100px;">Cidade mais populosa</h1>


    <table>
    <tr>
        <th>País</th>
        <th>Cidade</th>
        <th>População</th>
    </tr>

<?php
$sql_mais_populosa_por_pais = "
    SELECT 
        p.nome AS pais,
        c.nome AS cidade,
        c.populacao
    FROM tb_pais p
    JOIN tb_cidade c ON p.id_pais = c.id_pais
    WHERE c.populacao = (
        SELECT MAX(c2.populacao)
        FROM tb_cidade c2
        WHERE c2.id_pais = p.id_pais
    )
    ORDER BY p.nome;
";

$result5 = $conn->query($sql_mais_populosa_por_pais);

if ($result5 && $result5->num_rows > 0) {
    while ($row = $result5->fetch_assoc()) {
        echo "<tr>
                <td>{$row['pais']}</td>
                <td>{$row['cidade']}</td>
                <td>{$row['populacao']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>Nenhum dado encontrado.</td></tr>";
}
?>
</table>

<table>

    <tr>
        <th>Continente</th>
        <th>Total de Cidades</th>
    </tr>
    <h1 style="margin-top: 100px;">Total de Cidades por Continente</h1>
    <?php
    $sql_cidades_continente = "
        SELECT p.continente, COUNT(c.id_cidade) AS total_cidades
        FROM tb_pais p
        LEFT JOIN tb_cidade c ON p.id_pais = c.id_pais
        GROUP BY p.continente
        ORDER BY total_cidades DESC
    ";

    $result4 = $conn->query($sql_cidades_continente);

    if ($result4 && $result4->num_rows > 0) {
        while ($row = $result4->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['continente']}</td>
                    <td>{$row['total_cidades']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>Nenhum registro encontrado.</td></tr>";
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
