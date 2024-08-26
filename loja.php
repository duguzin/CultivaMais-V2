<?php
include("./conexao.php");

session_start(); // Inicie a sessão antes de acessar ou definir variáveis de sessão

// Obter ID do vendedor da URL
$vendedor_id = isset($_GET["vendedor_id"]) ? intval($_GET["vendedor_id"]) : null;

if ($vendedor_id) {
    // Consulta para buscar produtos do vendedor
    $sql = "SELECT produtos.*, usuarios.nome AS vendedor_nome 
            FROM produtos 
            LEFT JOIN usuarios ON produtos.usuario_id = usuarios.id 
            WHERE usuarios.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vendedor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifique se existem produtos
    if ($result->num_rows > 0) {
        $vendedor = $result->fetch_assoc(); // Pega o primeiro produto para obter o nome do vendedor
        $vendedor_nome = htmlspecialchars($vendedor['vendedor_nome']);
        ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Css/style.css">
    <link rel="stylesheet" href="./Css/style_responsive.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <title>CultivaMais</title>
    <style>
        .swiper-wrapper {
            height: auto;
            padding-bottom: 1rem;
        }
        @media (max-width: 1010px) {
          .section-main {
            padding-top: 6rem;
          }
        }
        @media (max-width: 650px) {
          #swiper-card {
            border: none;
            width: 100%;
            box-shadow: none;
          }
        }
        @media (max-width: 450px) {
          .section-main {
            padding: 5rem 1rem 2rem 1rem;
          }
          .nav-main {
            padding: 1rem;
          }
          .div-input-pesquisa-mobile {
            padding: 1rem;
          }
        }


    </style>
</head>
<body>
    <header>
    
      <nav class="nav-main">
        <div class="navbar-overlay" onclick="toggleCarrinhoOpen()"></div>
        <div class="navbar-overlay-mobile" onclick="toggleMenuOpen()"></div>
        <div class="navbar-overlay-input" onclick="toggleInputOpen()"></div>

          <div class="button-menu" onclick="toggleMenuOpen()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
          </div>

          <form class="input-pesquisa" action="pesquisar.php" method="GET">
              <input type="text" name="termo" class="input-pesquisa-active" placeholder="O que você está procurando?" required>
              <svg xmlns="http://www.w3.org/2000/svg" onclick="toggleInputOpen()" viewBox="0 0 512 512" id="svg-input"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
              <button type="submit" id="button-serch"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
          </form>

          <div class="div-fantasma"></div>

          <a href="./index.php" class="logo"><img src="./logo6.png" alt=""></a>

          <div class="div-input-cart-nav"> 
            <div class="svg-carrinho-mobile" onclick="toggleCarrinhoOpen()">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
            </div>
          </div>

          <div style="display: flex; gap: 10px;">
            
            <div class="svg-carrinho" onclick="toggleCarrinhoOpen()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                <p>( 0 )</p>
            </div>

            <?php if (isset($_SESSION["email"])): // Verifica se o usuário está logado ?>

              <?php if ($_SESSION["tipo_conta"] == "vendedor"): // Usuário é um vendedor ?>

                <!-- Conteúdo para vendedores -->
                <div class="svg-menu-painel" onclick="toggleMenuPainel()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!-- Ícone representando 'Minha Loja' -->
                        <path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64H240l-10.7 32H160c-17.7 0-32 14.3-32 32s14.3 32 32 32H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H346.7L336 416H512c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64zM512 64V288H64V64H512z"/>
                    </svg>
                    <p>Minha Loja</p>
                </div>

              <?php else: // Usuário é um consumidor ?>

                <!-- Conteúdo para consumidores -->
                <!-- Link para a página de login -->
                <form action="" method="post">
                  <button type="submit" name="logout" class="svg-menu-painel">
                      <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                          <!-- Ícone de logout -->
                          <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                      </svg>
                      <p>Sair</p>
                  </button>
                </form>

              <?php endif; ?>

              <?php else: // Usuário não está logado ?>

                <!-- Link para a página de login -->
                <a class="link-perfil" href="./login.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                        <!-- Ícone de login -->
                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                    </svg>
                </a>

              <?php endif; ?>

          </div>
          
          <div class="menu-carrinho">
            <div class="header-menu-carrinho">
              <h1>Seu carrinho</h1>
            </div>
            <div class="item-carrinho">
              <span>Seu carrinho ainda está vazio</span>
            </div>
          </div>
      </nav>

      <nav class="nav-menu">

        <li class="nav-list"><a href="./index.html" class="nav-links">Início</a></li>
        <li class="nav-list"><a href="./add-product.php" class="nav-links">Ofertas</a></li>
        <li class="nav-list"><a href="./meus-produtos.html" class="nav-links">Vender</a></li>
        <li class="nav-list"><a href="./painel.html" class="nav-links">Contato</a></li>
        
        <?php
          // Verifique se o usuário está logado
          if (isset($_SESSION["email"])) {
              // Se estiver logado, exiba a mensagem de boas-vindas com a classe desejada
              echo "<span id='nome-nav-login'>Olá, " . $_SESSION["nome"] . "!</span>";
          }
        ?>
      </nav>

      <nav class="nav-menu-mobile">
        <li class="nav-list"><a href="./add_product.php" class="nav-links">Adicionar produtos</a></li>
        <li class="nav-list"><a href="./meus_produtos.php" class="nav-links">Meus produtos</a></li>
        <li class="nav-list"><a href="#" class="nav-links">Minha Loja</a></li>
        <li class="nav-list"><a href="./meus-clientes.html" class="nav-links">Meus Clientes</a></li>
        <li class="nav-list"><a href="./status-pedido.html" class="nav-links">Meus Pedidos</a></li>
      </nav>

        <div class="swiper-text textSwiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #2ca0da">
         <div class="swiper-wrapper">
           <div class="swiper-slide" id="swiper-slide-text">
                <p>Frete grátis a partir de R$150</p>
            </div>
           <div class="swiper-slide" id="swiper-slide-text">
                <p>Temos os melhores padrões de qualidade</p>
            </div>
        </div>

        <form class="div-input-pesquisa-mobile" action="pesquisar.php" method="GET">
            <div class="input-pesquisa-mobile">
              <input type="text" name="termo" placeholder="O que você está procurando?">
                <button id="button-serch-mobile" type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" onclick="toggleInputOpen()" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                </button>
            </div>
        </form>

    </header>

    <main>

     <section class="section-main">    
          
            <h1 style="padding-top: 3rem; margin-bottom: 1rem;">Produtos de <?= $vendedor_nome ?></h1>
            <div class="swiper-card cardSwiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #004E29;">
                <div class="swiper-wrapper">
                <?php
                $productCounter = 0; // Contador para dividir produtos entre Swipers

                do {
                    // Se ultrapassar 5 produtos, inicie um novo Swiper
                    if ($productCounter > 0 && $productCounter % 5 == 0) {
                        ?>
                        </div> <!-- Fechar `swiper-wrapper` -->
                        <div class="swiper-pagination-card" style="padding-bottom: 2rem"></div>
                        </div> <!-- Fechar `swiper-card` -->
                        
                        <!-- Iniciar um novo Swiper -->
                        <div class="swiper-card cardSwiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #004E29;">
                            <div class="swiper-wrapper">
                        <?php
                    }

                    // Obter todas as imagens relacionadas ao produto
                    $produto_id = $vendedor['id'];
                    $sql_imagens = "SELECT imagem_path FROM produto_imagens WHERE produto_id = ?";
                    $stmt_imagens = $conn->prepare($sql_imagens);
                    $stmt_imagens->bind_param("i", $produto_id);
                    $stmt_imagens->execute();
                    $result_imagens = $stmt_imagens->get_result();

                    $imagem_path = $result_imagens->fetch_assoc(); // Obtém a primeira imagem
                    $stmt_imagens->close();

                    // Exibir detalhes do produto e a imagem
                    ?>
                    <div class="swiper-slide" id="swiper-card">
                        <div class="container-content-card">
                            <a href="item.php?id=<?= htmlspecialchars($produto_id) ?>">
                                <?php if ($imagem_path && file_exists($imagem_path['imagem_path'])): ?>
                                    <img class="img-produto-card" src="<?= htmlspecialchars($imagem_path['imagem_path']) ?>" alt="Produto">
                                <?php else: ?>
                                    <img class="img-produto-card" src="path/to/default/image.jpg" alt="Sem imagem">
                                <?php endif; ?>
                            </a>
                            <div class="div-favoritos">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M225.8 468.2l-2.5-2.3..."></path>
                                </svg>
                            </div>

                            <div style="padding: .5rem 1rem 1rem 1rem;">
                            <div class="rating">
                                  <input type="radio" id="star5" name="rate" value="5" />
                                  <label for="star5" title="text"><svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="star-solid"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg></label>
                                  <input type="radio" id="star4" name="rate" value="5" />
                                  <label for="star4" title="text"><svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="star-solid"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg></label>
                                  <input type="radio" id="star3" name="rate" value="5" />
                                  <label for="star3" title="text"><svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="star-solid"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg></label>
                                  <input type="radio" id="star2" name="rate" value="5" />
                                  <label for="star2" title="text"><svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="star-solid"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg></label>
                                  <input type="radio" id="star1" name="rate" value="5" />
                                  <label for="star1" title="text"><svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="star-solid"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg></label>
                            </div>

                            <h3 class="title-nome-produto"><?= htmlspecialchars($vendedor['nome']) ?></h3>
                            <h1 class="title-preço">R$ <?= number_format($vendedor['preco'], 2, ',', '.') ?> <span class="span-porcent"> 47% off</span></h1>
                            <div class="link-adicionar-carrinho">
                                <a href="item.php?id=<?= htmlspecialchars($produto_id) ?>">Ver</a>
                            </div>
                            </div>
                            
                        </div>
                    </div>
                    <?php

                    // Incrementar o contador de produtos
                    $productCounter++;
                } while ($vendedor = $result->fetch_assoc());

                // Fechar o último Swiper e adicionar a paginação
                ?>
                </div> <!-- Fechar `swiper-wrapper` -->
                <!-- <div class="swiper-pagination-card"></div> Adicionar paginação -->
            </div> <!-- Fechar `swiper-card` -->
        </div>
        <?php
    } else {
        ?>
        <div class="section-main">    
            <h1>Nenhum produto encontrado para este vendedor.</h1>
        </div>
        <?php
    }

    // Fechar a conexão com o banco de dados
    $stmt->close();
} else {
    echo "ID do vendedor não fornecido.";
}

$conn->close();
?>




    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4>Ajuda</h4>
                <ul>
                    <li><a href="#">Status do Pedido</a></li>
                    <li><a href="#">Envio e Entrega</a></li>
                    <li><a href="#">Devoluções</a></li>
                    <li><a href="#">Métodos de Pagamento</a></li>
                    <li><a href="#">Contate-nos</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Sobre CultivaMais</h4>
                <ul>
                    <li><a href="#">Notícias</a></li>
                    <li><a href="#">Carreiras</a></li>
                    <li><a href="#">Investidores</a></li>
                    <li><a href="#">Sustentabilidade</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Navegar</h4>
                <ul>
                    <li><a href="#">início</a></li>
                    <li><a href="#">Ofertas</a></li>
                    <li><a href="#">Categorias</a></li>
                    <li><a href="#">Vender</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Redes Sociais</h4>
                <ul class="social-icons">
                  <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg></a></li>
                  <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg></a></li>
                  <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg></a></li>
              </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 CultivaMais. Todos os direitos reservados.</p>
            <ul>
                <li><a href="#">Termos de Uso</a></li>
                <li><a href="#">Política de Privacidade</a></li>
            </ul>
        </div>
    </footer>
   
    </main>
    
    <script src="./Js/script.js"></script>
    <script type="module">
    import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.esm.browser.js'
  
    var swiper = new Swiper(".cardSwiper", {
    autoplay: {
    delay: 30000,
    disableOnInteraction: false,
    },
    navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
    },
    slidesPerView: 1,
    spaceBetween: 30,
    grabCursor: true,
    pagination: {
      el: ".swiper-pagination-card",
      clickable: true,
    },
    breakpoints: {
      1230: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      650: {
        slidesPerView: 2,
        spaceBetween: 20,
      }
    }
  });
  
  window.addEventListener('resize', function () {
    swiper.update(); // Atualiza o swiper quando a janela for redimensionada
  });
  var swiper = new Swiper(".swiper-card-img-item ", {
          autoplay: {
          delay: 30000,
          disableOnInteraction: false,
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    slidesPerView: 1,
    spaceBetween: 30,
    grabCursor: true,
    pagination: {
      el: ".swiper-pagination-card",
      clickable: true,
    },
    breakpoints: {
      1230: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
      }
    }
  });
  
  window.addEventListener('resize', function () {
    swiper.update(); // Atualiza o swiper quando a janela for redimensionada
  });

  var swiper = new Swiper(".textSwiper", {
        autoplay: {
        delay: 10000,
        disableOnInteraction: false,
      },
      keyboard: {
        enabled: true,
      },
      speed: 600,
      parallax: true,
      direction: 'horizontal',
      loop: true,
    });

</script>

<button onclick="voltarAoTopo()" id="btnVoltarTopo" class="escondido">
  <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#fff}</style><path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/></svg>
</button>

</body>
</html>