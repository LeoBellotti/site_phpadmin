<?php include 'includes/conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sobre a Empresa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilo.css">
</head>

<body class="d-flex flex-column min-vh-100 <?php echo (isset($_COOKIE['modo']) && $_COOKIE['modo'] === 'dark') ? 'dark-mode' : ''; ?>">
  <?php include 'includes/menu.php'; ?>

  <main class="flex-grow-1">
    <div class="container mt-4">
      <section class="text-section2">
      <div class="container text-center">
        <h2>Sobre nós</h2>
    </section>
    

     
      <div class="row align-items-center">
        
        <div class="col-md-7">
          <p>Fundada em 2023 por quatro grandes amigos — <strong>Leo, Alessandra, João e André</strong> — a <strong>Cervejaria Brew Lab</strong> nasceu de um sonho compartilhado: unir amizade, natureza e excelência na arte cervejeira.</p>

          <p>Localizada em meio às paisagens deslumbrantes da região serrana do estado do Rio de Janeiro, a cervejaria encontrou seu lar em um ambiente onde a brisa fresca da montanha se mistura ao aroma dos lúpulos e maltes importados diretamente da Bélgica.</p>

          <p>Toda a água utilizada na produção vem de nascentes cristalinas que descem direto das montanhas — águas puras, geladas e minerais, que dão às nossas cervejas uma identidade única.</p>
        </div>

        
        <div class="col-md-5 text-center">
          <img src="img/imgcerv.jpg" alt="Imagem da Cervejaria" class="img-fluid rounded shadow-sm mb-2">
          <small class="text-muted d-block">Vista da nossa unidade na serra</small>
        </div>
      </div>

      
      <div class="mt-4">
        <p>Nosso foco principal é a produção de <strong>cervejas de estilo belga</strong>, com receitas autênticas e cuidadosas, inspiradas nas tradições centenárias das abadias europeias. Cada gole carrega uma experiência sensorial rica, com corpo marcante, aromas frutados e final suave.</p>

        <p>Aqui, tradição e inovação andam lado a lado, em um ambiente onde cada detalhe importa — desde a escolha dos ingredientes até o rótulo da garrafa.</p>

       
      </div>
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