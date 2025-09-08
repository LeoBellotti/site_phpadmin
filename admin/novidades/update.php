<?php
include '../includes/verificar_sessao.php';
include '../conexao.php';

date_default_timezone_set('America/Sao_Paulo');

$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $data = date('Y-m-d H:i:s'); 

    $update_sql = "UPDATE novidades SET titulo = ?, conteudo = ?, data = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);

    if (!$stmt) {
        die("Erro na preparação: " . $conn->error);
    }

    $stmt->bind_param("sssi", $titulo, $conteudo, $data, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}


$sql = "SELECT * FROM novidades WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$novidade = $result->fetch_assoc();

if (!$novidade) {
    die("Novidade não encontrada.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial=1.0">
    <title>Editar Novidade</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body class="<?php echo (isset($_COOKIE['modo']) && $_COOKIE['modo'] === 'dark') ? 'dark-mode' : ''; ?>">
    <?php include '../includes/menuadm.php'; ?>
<br><br><br><br>
    <h1>Edição de Novidade</h1>
<br>
    <div class="form-container">
        <div class="container">
            <h2 class="form-title">Editar Novidade</h2>
            <form method="POST" class="form">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($novidade['titulo']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="conteudo">Conteúdo:</label>
                    <textarea id="conteudo" name="conteudo" rows="5" required><?= htmlspecialchars($novidade['conteudo']) ?></textarea>
                </div>
                <button type="submit">Atualizar</button>
                <a href="index.php" class="btn btn-secondary mt-2 w-100">Cancelar</a>
            </form>
        </div>
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