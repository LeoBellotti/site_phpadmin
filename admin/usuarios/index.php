<?php
include '../includes/verificar_sessao.php';
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

include '../conexao.php';
$usuario = $_SESSION['admin'];

$modo_atual = isset($_COOKIE['modo']) ? $_COOKIE['modo'] : 'light';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/estiloadm.css" rel="stylesheet">
</head>
<body class="<?php echo ($modo_atual === 'dark') ? 'dark-mode' : ''; ?>">

    <?php include '../includes/menuadm.php'; ?>
<br><br>
    <h1 class="text-center mt-5 mb-4">Gerenciar Usuários</h1>

    <div class="d-flex justify-content-center mb-4">
        <a href="create.php" class="btn btn-success">Novo Usuário</a>
    </div>

    <div class="user-cards-grid-container">
        <?php
        $sql = "SELECT * FROM usuarios";
        $res = $conn->query($sql);

        if ($res->num_rows > 0):
            while ($row = $res->fetch_assoc()):
                $completed_fields = 0;
                if (!empty($row['nome'])) $completed_fields++;
                if (!empty($row['endereco'])) $completed_fields++;
                if (!empty($row['telefone'])) $completed_fields++;
                if (!empty($row['email'])) $completed_fields++;
                if (!empty($row['sexo'])) $completed_fields++;
                
                $total_fields = 5;
                $profile_percentage = ($total_fields > 0) ? round(($completed_fields / $total_fields) * 100) : 0;
        ?>
                <div class="user-item-card">
                    <h2 class="user-name"><?= htmlspecialchars($row['nome']) ?></h2>
                    
                    <p><strong>ID:</strong> <?= htmlspecialchars($row['id']) ?></p>
                    <p><strong>Endereço:</strong> <?= htmlspecialchars($row['endereco']) ?></p>
                    <p><strong>Telefone:</strong> <?= htmlspecialchars($row['telefone']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                    <p><strong>Sexo:</strong> <?= htmlspecialchars($row['sexo']) ?></p>

                    

                    <div class="actions">
                        <a href="read.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-info">Ver</a>
                        <a href="update.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-warning">Editar</a>
                        <a href="delete.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                    </div>
                </div>
        <?php
            endwhile;
        else:
        ?>
            <p class="text-center w-100">Nenhum usuário cadastrado.</p>
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