<?php include("../conexao.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Adicionar País</title>
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
    let nome = document.forms["formPais"]["nome"].value.trim();
    let continente = document.forms["formPais"]["continente"].value.trim();
    let populacao = document.forms["formPais"]["populacao"].value.trim();
    let idioma = document.forms["formPais"]["idioma"].value.trim();

    if (!nome || !continente || !populacao || !idioma) {
        alert("Preencha todos os campos corretamente!");
        return false;
    }
    if (isNaN(populacao) || populacao <= 0) {
        alert("População deve ser um número positivo!");
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
<h1 style="  margin-top: 100px;">Adicionar País</h1>
<form name="formPais" method="post" onsubmit="return validar()">
    <label>Nome:</label>
    <input type="text" name="nome">
    <label>Continente:</label>
    <input type="text" name="continente">
    <label>População:</label>
    <input type="number" name="populacao">
    <label>Idioma:</label>
    <input type="text" name="idioma">
    <button type="submit" name="enviar">Salvar</button>
</form>

<?php
if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    $cont = $_POST['continente'];
    $pop = $_POST['populacao'];
    $idi = $_POST['idioma'];
    $sql = "INSERT INTO tb_pais (nome, continente, populacao, idioma)
            VALUES ('$nome', '$cont', '$pop', '$idi')";
    if ($conn->query($sql)) {
        echo "<script>alert('País adicionado!'); window.location='listar.php';</script>";
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
