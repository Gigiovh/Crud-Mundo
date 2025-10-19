<?php include("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Banco de Países e Cidades</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">
</head>
<body style="background-color:#fff9f9">
   
<!-- navegação  -->
<br><br>   
<nav class="test">
  <ul>
    <li><a href="index.php">Home</a></li>
    <li>
      <a href="pais/listar.php">Países</a>
      <ul>
        <li><a href="pais/adicionar.php">Adicionar</a></li>
       
      </ul>
    </li>
    <li>
      <a href="cidade/listar_cidade.php">Cidades</a>
      <ul>
        <li><a href="cidade/adicionar_cidade.php">Adicionar</a></li>
        
      </ul>
  </ul>
</nav>
<!-- Baner -->
 <div class="banner-container">
  <div class="banner-content">
    <h1 class="banner-title">DESIGN<br>BANNER</h1>
    <p class="banner-tag">CSS ONLY</p>
  </div>
</div>
<!-- Card a respeito de alguns países -->
 <section class="cards-container">
<article class="card">
  <img
    class="card__background"
    src="https://wallpaper.forfun.com/fetch/4b/4b49ebebb437fa2078fb5a3aa080ee58.jpeg"
    alt="berlim"
    width="1920"
    height="2193"
  />
  <div class="card__content | flow">
    <div class="card__content--container | flow">
      <h2 class="card__title">Berlim</h2>
      <p class="card__description">
       Uma metrópole que reinventa o passado com estilo, cheia de arte, liberdade e vida noturna inesquecível.
      </p>
    </div>
  
  </div>
</article>
<article class="card">
  <img
    class="card__background"
    src="https://images.unsplash.com/photo-1550759825-41ba5b154aa7?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8c2FvJTIwcGF1bG98ZW58MHx8MHx8fDA%3D&fm=jpg&q=60&w=3000"
    alt="sp"
    width="1920"
    height="2193"
  />
  <div class="card__content | flow">
    <div class="card__content--container | flow">
      <h2 class="card__title">São Paulo</h2>
      <p class="card__description">
      Energia que nunca para, sabores de todo o mundo e cultura em cada esquina da maior cidade do Brasil.
      </p>
    </div>
   
  </div>
</article>
<article class="card">
  <img
    class="card__background"
    src="https://images.unsplash.com/photo-1503899036084-c55cdd92da26?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dCVDMyVCM3F1aW98ZW58MHx8MHx8fDA%3D&fm=jpg&q=60&w=3000"
    alt="Toquio"
    width="1920"
    height="2193"
  />
  <div class="card__content | flow">
    <div class="card__content--container | flow">
      <h2 class="card__title">Tóquio</h2>
      <p class="card__description">
      Um espetáculo de luzes, tradição e inovação, onde o futuro e o encanto japonês caminham lado a lado.
      </p>
    </div>
    
  </div>
</article>
</section>
<!-- Footer -->
<footer class="footer">
  <h2 class="footer-logo">Clement's World</h2>

  <div class="footer-social">
    <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
    <a href="https://github.com/Gigiovh" target="_blank"><i class="fab fa-github"></i></a>
    <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
  </div>

  <p class="footer-copy">
    Clement's World ©2025 Todos os direitos reservados a <a href="https://github.com/Gigiovh">Gigiovh</a>
    <span class="heart">★</span> 
  </p>
</footer>
</body>

</html>
