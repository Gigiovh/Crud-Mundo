<?php
include("../conexao.php");
$id = $_GET['id'];

// Não pode excluir  cidades vinculadas aos países 
$res = $conn->query("SELECT * FROM tb_cidade WHERE id_pais=$id");
if ($res->num_rows > 0) {
    echo "<script>alert('Não é possível excluir: há cidades vinculadas a este país!'); window.location='listar.php';</script>";
} else {
    $conn->query("DELETE FROM tb_pais WHERE id_pais=$id");
    echo "<script>alert('País excluído com sucesso!'); window.location='listar.php';</script>";
}
?>
