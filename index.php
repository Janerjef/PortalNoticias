<?php
$url = "https://takta.com.br/wp-json/wp/v2/posts?per_page=10&_embed"; // link da API
$ch = curl_init($url); // inicia uma sessão/conexão
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // retorna a resposta como string
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // ignora verificação SSL para evitar o erro 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch); // requisição armazenando o resultado 
// Mostra erro se falhar
if(curl_errno($ch)) {
    die("Erro cURL: " . curl_error($ch));
} // mostra mensagem de erro 
$posts = json_decode($response, true); // transforma em um arrays php 
// garante que é array
if(!is_array($posts)) {
    die("Erro ao buscar posts. Resposta: " . $response);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Header Takta</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="top-bar"></div>

  <header class="header">
    <div class="logo">
    <img src="https://takta.com.br/wp-content/themes/takta-2024.iwwa/img/logos/logo.svg" alt="logotaktá">
    </div>

    <div class="right">
      <div class="icons">
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="currentColor" d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm5 5a5 5 0 110 10 5 5 0 010-10zm6.5-.9a1.1 1.1 0 110 2.2 1.1 1.1 0 010-2.2z"/>
        </svg>
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="currentColor" d="M16 3c.3 1.7 1.6 3 3.3 3.3v3c-1.2 0-2.3-.3-3.3-.9v6.1a5.5 5.5 0 11-5.5-5.5c.4 0 .7 0 1 .1v3.1c-.3-.1-.6-.2-1-.2a2.5 2.5 0 102.5 2.5V3h3z"/>
        </svg>
      </div>

      <button class="btn">
        Ouça Agora
        <div class="icon">
            <svg width="40" height="20" viewBox="0 0 40 20" xmlns="http://www.w3.org/2000/svg">
              <rect x="2"  y="6" width="3" height="8" rx="1.5" fill="#FFFFFF"/>
              <rect x="8"  y="4" width="3" height="12" rx="1.5" fill="#FFFFFF"/>
              <rect x="14" y="2" width="3" height="16" rx="1.5" fill="#FFFFFF"/>
              <rect x="20" y="5" width="3" height="10" rx="1.5" fill="#FFFFFF"/>
              <rect x="26" y="3" width="3" height="14" rx="1.5" fill="#FFFFFF"/>
            </svg>
        </div>
      </button>
    </div>
  </header>

  <nav class="menu">
    <a class="active" href="#">Home</a>
    <a href="#">Últimas</a>
    <a href="#">Polícia</a>
    <a href="#">Municípios</a>
    <a href="#">Política</a>
    <a href="#">Entretenimento</a>
    <a href="#">Esporte</a>
    <a href="#">Brasil</a>
    <a href="#">Colunistas</a>
  </nav>

<section class="carrossel-container">
  <div class="carrossel">
    <?php foreach($posts as $index => $post): ?> 
      <?php // inicia o loop dos post
        $img_url = $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? '';
        //   dados trazidos da API > array > o numero do array > url da imagem > 
      ?>
      <div class="slide-carrossel <?= $index === 0 ? 'ativo' : '' ?>">
        <div class="card">
          <div class="texto">
            <p class="tag">Notícia</p>
            <h2><?= $post['title']['rendered']; ?></h2>
            <p>
              <?= substr(strip_tags($post['excerpt']['rendered']), 0, 120); ?>...
            </p>
          </div>
          <div class="imagem">
            <img src="<?= $img_url ?>" alt="">
          </div>
        </div>

      </div>
    <?php endforeach; ?>
  </div>

</section>

<main>
    <?php foreach(array_slice($posts, 0, 3) as $post): ?>
      <?php
        $img_url = $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? '';
      ?>
      <div class="slide">
          <div >
            <img src="<?= $img_url ?>" alt="">
          </div>
        <div class="descricao">
          <h2><?= $post['title']['rendered']; ?></h2>
          <p>
            <?= substr(strip_tags($post['excerpt']['rendered']), 0, 150); ?>...
          </p>
        </div>
      </div>
    <?php endforeach; ?>  
  </main>

      <section>
            <div class="ntprincipal">
    <?php foreach(array_slice($posts, 0, 1) as $index => $post): ?>
      <?php
        $img_url = $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? '';
      ?>
      <div class="slide-carrossel <?= $index === 0 ? 'ativo' : '' ?>">
        <div class="card">
          <div class="texto">
            <h2><?= $post['title']['rendered']; ?></h2>
            <p>
              <?= substr(strip_tags($post['excerpt']['rendered']), 0, 120); ?>...
            </p>
          </div>
          <div class="imagem">
            <img src="<?= $img_url ?>" alt="">
          </div>
        </div>          

      </div>
    <?php endforeach; ?>
  </div>
      </section>
      <footer class="footer">

  <div class="footer-container">

    <!-- Logo / marca -->
    <div class="footer-col">
      <img src="https://takta.com.br/wp-content/themes/takta-2024.iwwa/img/logos/logo.svg" alt="logo" class="footer-logo">
      <p>Portal de notícias com informação rápida, confiável e atualizada.</p>
    </div>

    <!-- Menu -->
    <div class="footer-col">
      <h3>Menu</h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Política</a></li>
        <li><a href="#">Esporte</a></li>
        <li><a href="#">Entretenimento</a></li>
      </ul>
    </div>

    <!-- Contato -->
    <div class="footer-col">
      <h3>Contato</h3>
      <p>Email: contato@taktanoar.com</p>
      <p>Telefone: (00) 0000-0000</p>
    </div>

    <!-- Redes -->
    <div class="footer-col">
      <h3>Redes</h3>

      <div class="socials">
        <!-- Instagram -->
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path fill="currentColor" d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm5 5a5 5 0 110 10 5 5 0 010-10zm6.5-.9a1.1 1.1 0 110 2.2 1.1 1.1 0 010-2.2z"/>
        </svg>

        <!-- TikTok -->
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path fill="currentColor" d="M16 3c.3 1.7 1.6 3 3.3 3.3v3c-1.2 0-2.3-.3-3.3-.9v6.1a5.5 5.5 0 11-5.5-5.5c.4 0 .7 0 1 .1v3.1c-.3-.1-.6-.2-1-.2a2.5 2.5 0 102.5 2.5V3h3z"/>
        </svg>
      </div>

    </div>

  </div>

  <!-- Linha final -->
  <div class="footer-bottom">
    <p>© 2026 Taktá no Ar - Todos os direitos reservados</p>
  </div>

</footer>


<script>
    let slides = document.querySelectorAll('.slide-carrossel');
    let index = 0;

    setInterval(() => {
      slides[index].classList.remove('ativo');
      index = (index + 1) % slides.length;
      slides[index].classList.add('ativo');
        }, 7000);
</script>
</body>
</html>