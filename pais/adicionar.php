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
<h1>Adicionar País</h1>
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
</html>

