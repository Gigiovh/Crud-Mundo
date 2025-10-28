<?php include("../conexao.php");
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tb_pais WHERE id_pais=$id");
$pais = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar País</title>
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
    let pop = document.forms["formPais"]["populacao"].value;
    if (isNaN(pop) || pop <= 0) {
        alert("População inválida!");
        return false;
    }
}
</script>
</head>
<body>
<h1>Editar País</h1>
<form name="formPais" method="post" onsubmit="return validar()">
    <input type="hidden" name="id" value="<?= $pais['id_pais'] ?>">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= $pais['nome'] ?>">
    <label>Continente:</label>
    <input type="text" name="continente" value="<?= $pais['continente'] ?>">
    <label>População:</label>
    <input type="number" name="populacao" value="<?= $pais['populacao'] ?>">
    <label>Idioma:</label>
    <input type="text" name="idioma" value="<?= $pais['idioma'] ?>">
    <button type="submit" name="salvar">Salvar Alterações</button>
</form>

<?php
if (isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $cont = $_POST['continente'];
    $pop = $_POST['populacao'];
    $idi = $_POST['idioma'];
    $id = $_POST['id'];
    $sql = "UPDATE tb_pais SET nome='$nome', continente='$cont', populacao='$pop', idioma='$idi' WHERE id_pais=$id";
    if ($conn->query($sql)) {
        echo "<script>alert('País atualizado!'); window.location='listar.php';</script>";
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
