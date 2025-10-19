<?php
include("../conexao.php");
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tb_cidade WHERE id_cidade=$id");
$cidade = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Cidade</title>
<link rel="stylesheet" href="../style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">
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
<h1>Editar Cidade</h1>
<form name="formCidade" method="post" onsubmit="return validar()">
    <input type="hidden" name="id_cidade" value="<?= $cidade['id_cidade'] ?>">

    <label>Nome da cidade:</label>
    <input type="text" name="nome" value="<?= $cidade['nome'] ?>">

    <label>População:</label>
    <input type="number" name="populacao" value="<?= $cidade['populacao'] ?>">

    <label>País:</label>
    <select name="id_pais">
        <?php
        $res = $conn->query("SELECT * FROM tb_pais ORDER BY nome");
        while($row = $res->fetch_assoc()) {
            $selected = ($row['id_pais'] == $cidade['id_pais']) ? "selected" : "";
            echo "<option value='{$row['id_pais']}' $selected>{$row['nome']}</option>";
        }
        ?>
    </select>

    <button type="submit" name="salvar">Salvar Alterações</button>
</form>

<?php
if (isset($_POST['salvar'])) {
    $id = $_POST['id_cidade'];
    $nome = $_POST['nome'];
    $pop = $_POST['populacao'];
    $pais = $_POST['id_pais'];

    $sql = "UPDATE tb_cidade SET nome='$nome', populacao='$pop', id_pais='$pais' WHERE id_cidade=$id";
    if ($conn->query($sql)) {
        echo "<script>alert('Cidade atualizada!'); window.location='listar_cidade.php';</script>";
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
