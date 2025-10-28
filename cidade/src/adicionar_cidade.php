<?php include("../conexao.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Adicionar Cidade</title>
<link rel="stylesheet" href="../style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<script>
function validar() {
    let nome = document.forms["formCidade"]["nome"].value.trim();
    let populacao = document.forms["formCidade"]["populacao"].value.trim();
    let pais = document.forms["formCidade"]["id_pais"].value;

    if (!nome || !populacao || pais === "") {
        alert("Preencha todos os campos!");
        return false;
    }
    if (isNaN(populacao) || populacao <= 0) {
        alert("A população deve ser um número positivo!");
        return false;
    }
}
</script>
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

<h1 style="  margin-top: 100px;">Adicionar Cidade</h1>
<form name="formCidade" method="post" onsubmit="return validar()">
    <label>Nome da cidade:</label>
    <input type="text" name="nome">

    <label>População:</label>
    <input type="number" name="populacao">

    <label>País:</label>
    <select name="id_pais">
        <option value="">Selecione um país</option>
        <?php
        $res = $conn->query("SELECT * FROM tb_pais ORDER BY nome");
        while($row = $res->fetch_assoc()) {
            echo "<option value='{$row['id_pais']}'>{$row['nome']}</option>";
        }
        ?>
    </select>

    <button type="submit" name="enviar">Salvar</button>
</form>

<?php
if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    $pop = $_POST['populacao'];
    $pais = $_POST['id_pais'];

    $sql = "INSERT INTO tb_cidade (nome, populacao, id_pais)
            VALUES ('$nome', '$pop', '$pais')";
    if ($conn->query($sql)) {
        echo "<script>alert('Cidade adicionada com sucesso!'); window.location='listar_cidade.php';</script>";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>
</body>

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
</html>
