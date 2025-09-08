<?php
include '../includes/verificar_sessao.php';
include '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $preco = $_POST['preco'];

  $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nome, $descricao, $preco);    
  $stmt->execute();

  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novo Produto</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/form.css">
</head>
<body class="<?php echo (isset($_COOKIE['modo']) && $_COOKIE['modo'] === 'dark') ? 'dark-mode' : ''; ?>">
<?php include '../includes/menuadm.php'; ?>
<br><br><br>
  <h1>Cadastro de Produto</h1>

  <div class="form-container">
    <div class="container">
      <h2 class="form-title">Novo Produto</h2>
      <form method="POST" class="form">
        <div class="form-group">
          <label for="nome">Nome:</label>
          <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
          <label for="descricao">Descrição:</label>
          <input type="text" id="descricao" name="descricao" required>
        </div>
        <div class="form-group">
          <label for="preco">Preço:</label>
          <input type="text" id="preco" name="preco" required>
        </div>
        <button type="submit">Salvar</button>
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
