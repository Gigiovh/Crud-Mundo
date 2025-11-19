<?php include("../conexao.php"); 

// Primeiro, vamos verificar e criar as colunas se não existirem
function verificarECriarColunas($conn) {
    $colunas = [
        'capital' => 'VARCHAR(100) DEFAULT NULL',
        'moeda' => 'VARCHAR(50) DEFAULT NULL', 
        'bandeira' => 'VARCHAR(255) DEFAULT NULL'
    ];
    
    foreach ($colunas as $coluna => $tipo) {
        $result = $conn->query("SHOW COLUMNS FROM tb_pais LIKE '$coluna'");
        if ($result->num_rows == 0) {
            $conn->query("ALTER TABLE tb_pais ADD COLUMN $coluna $tipo");
        }
    }
}

// Executar a verificação/criação das colunas
verificarECriarColunas($conn);

function completarInformacoesPaisesAPI($conn) {
    // Buscar todos os países do banco que não têm informações completas
    $result = $conn->query("SELECT id_pais, nome FROM tb_pais WHERE capital IS NULL OR moeda IS NULL OR bandeira IS NULL");
    
    if (!$result) {
        return ['success' => false, 'message' => "❌ Erro ao buscar países do banco."];
    }
    
    if ($result->num_rows === 0) {
        return ['success' => true, 'message' => "✅ Todos os países já têm informações completas.", 'count' => 0];
    }
    
    $atualizadosCount = 0;
    $errosCount = 0;
    
    while ($row = $result->fetch_assoc()) {
        $idPais = $row['id_pais'];
        $nomePais = $row['nome'];
        
        echo "<!-- Processando: $nomePais -->\n"; // Debug
        
        // Buscar informações do país na API
        $apiUrl = "https://restcountries.com/v3.1/name/" . urlencode($nomePais);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        if ($resp && $httpCode === 200) {
            $dados = json_decode($resp, true);
            
            if (is_array($dados) && isset($dados[0])) {
                $paisData = $dados[0];
                
                // Extrair informações
                $capital = isset($paisData['capital'][0]) ? $paisData['capital'][0] : 'Desconhecida';
                $bandeira = $paisData['flags']['png'] ?? $paisData['flags']['svg'] ?? '';
                
                $moeda = 'Desconhecida';
                if (!empty($paisData['currencies']) && is_array($paisData['currencies'])) {
                    $moedas = [];
                    foreach ($paisData['currencies'] as $currencyCode => $currency) {
                        $moedas[] = $currency['name'] ?? $currencyCode;
                    }
                    $moeda = implode(', ', array_filter($moedas));
                }
                
                // Sanitizar dados
                $capital = mb_substr(trim($capital), 0, 100);
                $moeda = mb_substr(trim($moeda), 0, 50);
                $bandeira = mb_substr(trim($bandeira), 0, 255);
                
                // Atualizar o país no banco
                $stmt = $conn->prepare("UPDATE tb_pais SET capital = ?, moeda = ?, bandeira = ? WHERE id_pais = ?");
                if ($stmt) {
                    $stmt->bind_param("sssi", $capital, $moeda, $bandeira, $idPais);
                    if ($stmt->execute()) {
                        $atualizadosCount++;
                    } else {
                        $errosCount++;
                    }
                    $stmt->close();
                } else {
                    $errosCount++;
                }
            } else {
                $errosCount++;
            }
        } else {
            $errosCount++;
        }
    }
    
    $mensagem = "✅ Informações completadas! $atualizadosCount países atualizados.";
    if ($errosCount > 0) {
        $mensagem .= " $errosCount países com erro.";
    }
    
    return [
        'success' => true, 
        'message' => $mensagem,
        'count' => $atualizadosCount
    ];
}

// Processar completar informações se solicitado
if (isset($_GET['completar']) && $_GET['completar'] == 'true') {
    $resultado = completarInformacoesPaisesAPI($conn);
    
    if ($resultado['success']) {
        $mensagemSucesso = $resultado['message'];
    } else {
        $mensagemErro = $resultado['message'];
    }
}
?>
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
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>

    <nav class="test">
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li>
                <a href="listar.php">Países</a>
                <ul>
                    <li><a href="adicionar.php">Adicionar</a></li>
                    <li><a href="listar.php?completar=true" onclick="return confirm('Esta ação buscará capital, moeda e bandeira para os países que não têm essas informações. Deseja continuar?')">Completar Informações da API</a></li>
                </ul>
            </li>
            <li>
                <a href="../cidade/listar_cidade.php">Cidades</a>
                <ul>
                    <li><a href="../cidade/adicionar_cidade.php">Adicionar</a></li>
                </ul>
            </li>
            <li><a href="estatistica.php">Estatistica</a></li>
        </ul>
    </nav>

    <!-- Mensagens de sucesso/erro -->
    <?php if (isset($mensagemSucesso)): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; margin-top: 100px; border-radius: 5px; border: 1px solid #c3e6cb;">
            <?php echo $mensagemSucesso; ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($mensagemErro)): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 15px; margin-top: 100px; border-radius: 5px; border: 1px solid #f5c6cb;">
            <?php echo $mensagemErro; ?>
        </div>
    <?php endif; ?>

    <!-- Listagem de países -->
    <h1 style="margin-top: 100px;">Lista de Países</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Continente</th>
            <th>População</th>
            <th>Idioma</th>
            <th>Capital</th>
            <th>Moeda</th>
            <th>Bandeira</th>
            <th>Ações</th>
        </tr>

        <?php
$result = $conn->query("SELECT * FROM tb_pais ORDER BY nome");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bandeira = (!empty($row['bandeira'])) 
            ? "<img src='" . htmlspecialchars($row['bandeira'], ENT_QUOTES) . "' width='40' alt='Bandeira'>" 
            : "—";
        
        $capital = !empty($row['capital']) ? $row['capital'] : '—';
        $moeda = !empty($row['moeda']) ? $row['moeda'] : '—';

        echo "<tr>
                <td>{$row['id_pais']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['continente']}</td>
                <td>" . number_format($row['populacao'], 0, ',', '.') . "</td>
                <td>{$row['idioma']}</td>
                <td>{$capital}</td>
                <td>{$moeda}</td>
                <td>{$bandeira}</td>
                <td>
                    <a href='editar.php?id={$row['id_pais']}'>Editar</a> |
                    <a href='excluir.php?id={$row['id_pais']}' onclick='return confirm(\"Tem certeza?\")'>
                        <span style='color:red;'>Excluir</span>
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='9' style='text-align: center;'>Nenhum país encontrado.</td></tr>";
}
?>
    </table>
    <div style="margin: 20px 0;">
        <a href="listar.php?completar=true" onclick="return confirm('Esta ação buscará capital, moeda e bandeira para os países. Deseja continuar?')" 
           style="background: #2b2b2bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 15px; display: inline-block;">
            <i class="fas fa-sync-alt"></i> Completar Informações da API
        </a>
    </div>
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
