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
<h1>Adicionar Cidade</h1>
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
</html>
