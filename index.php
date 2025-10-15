<?php include("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Banco de Países e Cidades</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">
</head>
<body>
   
<!-- navegação para cidade e paises -->
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
<br><br>
 <h1>Bem-vindo ao BD Mundo</h1>
<!-- Card a respeito de alguns países -->
 <section class="cards-container">
<article class="card">
  <img
    class="card__background"
    src="https://i.imgur.com/QYWAcXk.jpeg"
    alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
    width="1920"
    height="2193"
  />
  <div class="card__content | flow">
    <div class="card__content--container | flow">
      <h2 class="card__title">Colombia</h2>
      <p class="card__description">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum in
        labore laudantium deserunt fugiat numquam.
      </p>
    </div>
    <button class="card__button">Read more</button>
  </div>
</article>
<article class="card">
  <img
    class="card__background"
    src="https://i.imgur.com/QYWAcXk.jpeg"
    alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
    width="1920"
    height="2193"
  />
  <div class="card__content | flow">
    <div class="card__content--container | flow">
      <h2 class="card__title">Colombia</h2>
      <p class="card__description">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum in
        labore laudantium deserunt fugiat numquam.
      </p>
    </div>
    <button class="card__button">Read more</button>
  </div>
</article>
<article class="card">
  <img
    class="card__background"
    src="https://i.imgur.com/QYWAcXk.jpeg"
    alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
    width="1920"
    height="2193"
  />
  <div class="card__content | flow">
    <div class="card__content--container | flow">
      <h2 class="card__title">Colombia</h2>
      <p class="card__description">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum in
        labore laudantium deserunt fugiat numquam.
      </p>
    </div>
    <button class="card__button">Read more</button>
  </div>
</article>
</section>
</body>
</html>
