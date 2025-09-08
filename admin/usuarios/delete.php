<?php 
include '../includes/verificar_sessao.php';
include '../conexao.php';

$id = $_GET['id'] ?? 0;
$conn->query("DELETE FROM usuarios WHERE id=$id");
header("Location: index.php");
exit; ?>
