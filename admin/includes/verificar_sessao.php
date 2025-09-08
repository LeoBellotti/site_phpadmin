<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    die('Acesso direto a este script não é permitido.');
}


session_start();


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


if (!isset($_SESSION['admin'])) {
    
    header("Location: ../login.php");
    exit;
}


$tempo_limite = 300;

if (isset($_SESSION['ultimo_acesso']) && (time() - $_SESSION['ultimo_acesso'] > $tempo_limite)) {
    
    session_unset();
    session_destroy();
    
    
    header("Location: ../login.php?timeout=1");
    exit;
}


$_SESSION['ultimo_acesso'] = time();


$usuario = $_SESSION['admin'];

?>