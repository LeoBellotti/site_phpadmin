<?php include 'includes/conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novidades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body class="d-flex flex-column min-vh-100 <?php echo (isset($_COOKIE['modo']) && $_COOKIE['modo'] === 'dark') ? 'dark-mode' : ''; ?>">
    <?php include 'includes/menu.php'; ?>
    
    <main class="flex-grow-1 container mt-4">
        <h2>Novidades</h2>
        <div class="row"> <?php
            $sql = "SELECT * FROM novidades ORDER BY data DESC";
            $res = $conn->query($sql);
            if ($res) {
                while($row = $res->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-3'> <div class='card'> <div class='card-body'>
                                      <h5 class='card-title'>{$row['titulo']}</h5>
                                      <p class='card-text'>{$row['conteudo']}</p>
                                      <small class='text-muted'>Publicado em: {$row['data']}</small>
                                  </div>
                              </div>
                          </div>";
                }
            } else {
                echo "<p>Erro ao carregar as novidades: " . $conn->error . "</p>";
            }
            ?>
        </div>
    </main>

    <?php include('includes/footer.php'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('toggle-dark');
            const body = document.body;

            if (localStorage.getItem('modo') === 'dark') {
                body.classList.add('dark-mode');
                document.cookie = "modo=dark; path=/";
            }

            if (toggle) {
                toggle.addEventListener('click', function () {
                    body.classList.toggle('dark-mode');
                    const modo = body.classList.contains('dark-mode') ? 'dark' : 'light';
                    localStorage.setItem('modo', modo);
                    document.cookie = "modo=" + modo + "; path=/";
                });
            }
        });
    </script>
</body>
</html>