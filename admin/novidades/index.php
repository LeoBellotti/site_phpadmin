<?php
include '../includes/verificar_sessao.php';
include '../conexao.php';



$modo_atual = isset($_COOKIE['modo']) ? $_COOKIE['modo'] : 'light';

$sql = "SELECT id, titulo, conteudo, data FROM novidades";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Novidades</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estiloadm.css"> 
</head>
<body class="<?php echo ($modo_atual === 'dark') ? 'dark-mode' : ''; ?>">

    <?php include '../includes/menuadm.php'; ?>
    
<br><br>
    <h1 class="text-center mt-5 mb-4">Gerenciar Novidades</h1>

    <div class="d-flex justify-content-center mb-4">
        <a href="create.php" class="btn btn-success">Adicionar Novidade</a>
    </div>

    <div class="user-cards-grid-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="user-item-card">
                    <h2 class="user-name"><?= htmlspecialchars($row['titulo']) ?></h2>
                    
                    <p><strong>ID:</strong> <?= htmlspecialchars($row['id']) ?></p>
                    <p><strong>Conteúdo:</strong> <?= htmlspecialchars(mb_strimwidth($row['conteudo'], 0, 150, '...')) ?></p> <p><strong>Data e Hora:</strong> <?= date('d/m/Y H:i', strtotime($row['data'])) ?></p>

                    <div class="actions">
                        <a href="read.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-info">Ver</a>
                        <a href="update.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-warning">Editar</a>
                        <a href="delete.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta novidade?')">Excluir</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center w-100">Nenhuma novidade encontrada.</p>
        <?php endif; ?>
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