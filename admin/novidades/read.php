<?php
include '../includes/verificar_sessao.php';
include '../conexao.php';

date_default_timezone_set('America/Sao_Paulo');

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM novidades WHERE id = $id";
$res = $conn->query($sql);

$novidade = null;
if ($res && $res->num_rows > 0) {
    $novidade = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalhes da Novidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/form.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="<?php echo (isset($_COOKIE['modo']) && $_COOKIE['modo'] === 'dark') ? 'dark-mode' : ''; ?>">
    <?php include '../includes/menuadm.php'; ?>
    <br><br><br>
<br><br>
    <div class="container py-4">
        
        <h1>Detalhes da Novidade</h1>

        <?php if ($novidade): ?>
        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> <?= $novidade['id'] ?></li>
            <li class="list-group-item"><strong>Título:</strong> <?= htmlspecialchars($novidade['titulo']) ?></li>
            <li class="list-group-item"><strong>Conteúdo:</strong> <?= nl2br(htmlspecialchars($novidade['conteudo'])) ?></li>
            <li class="list-group-item"><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($novidade['data'])) ?></li>
        </ul>
        <?php else: ?>
            <div class="alert alert-warning">Novidade não encontrada.</div>
        <?php endif; ?>

        <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('toggle-dark');
    const body = document.body;

    
    if (localStorage.getItem('modo') === 'dark') {
        body.classList.add('dark-mode');
    }

    
    if (toggle) {
        toggle.addEventListener('click', function () {
            
            body.classList.toggle('dark-mode');
            
            
            const modo = body.classList.contains('dark-mode') ? 'dark' : 'light';
            
            
            localStorage.setItem('modo', modo);
            
            
            document.cookie = "modo=" + modo + "; path=/; SameSite=Lax";
        });
    }
});
</script>
</body>
</html>