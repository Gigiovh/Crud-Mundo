<?php
include("../conexao.php");
$id = $_GET['id'];

$sql = "DELETE FROM tb_cidade WHERE id_cidade=$id";
if ($conn->query($sql)) {
    echo "<script>alert('Cidade excluída com sucesso!'); window.location='../cidade/listar.php';</script>";
} else {
    echo "Erro: " . $conn->error;
}
?>
