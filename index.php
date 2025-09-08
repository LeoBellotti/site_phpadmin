<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bem-vindo à Nossa Empresa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilo.css"> 

</head>

<body class="<?php echo (isset($_COOKIE['modo']) && $_COOKIE['modo'] === 'dark') ? 'dark-mode' : ''; ?>">
  <?php include 'includes/menu.php'; ?>
 
  <main>
    <header class="bg-primary text-white text-center py-5">
      <div class="container">
        <h1>Bem-vindo à Nossa Empresa</h1>
        <p class="lead">Inovando com qualidade e compromisso desde 2024</p>
      </div>
    </header>

    <section class="container mt-5">
      <div class="row">
        <div class="col-md-6">
          <h2>Quem Somos</h2>
          <p>Na Cervejaria Brew Lab, somos mais do que produtores de cerveja — somos quatro amigos unidos por um sonho e uma paixão em comum: transformar a arte cervejeira em uma experiência autêntica. Fundada em meio às montanhas do Rio de Janeiro, nossa cervejaria une o frescor da natureza à tradição belga, criando rótulos únicos e cheios de personalidade. Nossa missão é oferecer sabores que contam histórias, cultivando a excelência em cada etapa do processo, desde a água cristalina da serra até os lúpulos importados diretamente da Bélgica.</p>
        </div>
        <div class="col-md-6">
   
        </div>
      </div>
    </section>

    <section class="text-section">
      <div class="container text-center">
        <h2>Nossos Valores</h2>
        <p>Nosso compromisso é com a qualidade, a transparência e a conexão humana. Acreditamos que cada cerveja carrega um pedaço de quem somos: ingredientes bem escolhidos, respeito à tradição, inovação constante e um toque de amizade verdadeira. Valorizamos o trabalho artesanal, o cuidado com o meio ambiente e a experiência do cliente — afinal, cada detalhe importa quando o objetivo é surpreender com sabor e autenticidade.</p>
      </div>
    </section>
  </main>

  <?php include('includes/footer.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
