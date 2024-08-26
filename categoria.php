<?php

include("conexao.php");
// Inicie a sessão antes de acessar ou definir variáveis de sessão
session_start();

// Query para selecionar os produtos
$sql = "SELECT p.id, p.nome, p.preco, pi.imagem_path 
        FROM produtos p 
        LEFT JOIN produto_imagens pi ON p.id = pi.produto_id";
$result = $conn->query($sql);


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


        .div-input-pesquisa-mobile {
          box-shadow: none;
        }
  

        span#nome-nav-login {
            color: #000;
            position: absolute;
            right: 60px;
            font-size: 16px;
        }

        .logo img {
           width: 45px;
           height: 45px;
        }
     
        body {
            background-color: #f0f2f5;           
        }

        .section-categoria {
            padding: 3rem 2rem;
        }

        .logo img {
            width: 45px;
            height: 45px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            margin-bottom: 30px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .grid-item {
            background-color: #fff;
            border: 1px solid #004E29;
            border-radius: 3px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            border-bottom-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        /* .grid-item:hover {
            transform: scale(1.05);
        } */

        .img-produto {
            width: 100%;
            height: 200px;
            display: block;
        }

        .product-info {
            padding: 15px;
        }

        .title-nome-produto {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        .title-preco {
            font-size: 16px;
            font-weight: 400;
        }
        #label-categoria {
          font-size: 22px;
        }
        #button-search-categoria {
          padding: 5px;
          border-radius: 3px;
          cursor: pointer;
        }

        #select-categoria {
          padding: 5px;
          margin-left: 10px;
          border-radius: 3px;
        }

        @media (max-width: 1010px) {
          .section-categoria {
            padding: 8rem 2rem 2rem 2rem;
          }
        }
        @media (max-width: 700px) {
          .section-categoria {
            padding: 8rem 2rem 2rem 2rem;
          }
        }
        @media (max-width: 600px) {
          .grid-item {
            border: none;
          }
          .img-produto {
            height: 300px;
          }
          .grid-container {
            gap: 30px;
          }
        }

        @media (max-width: 500px) {
          .nav-main, .div-input-pesquisa-mobile {
            padding: 1rem;
          }
          .section-categoria {
            padding: 8rem 1rem 2rem 1rem;
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

          <div style="display: flex;">
          <div class="svg-carrinho" onclick="toggleCarrinhoOpen()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
            <p>( 0 )</p>
          </div>
          <a class="link-perfil" href="./login.html">
            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
          </a>
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
        <li class="nav-list"><a href="./add-product.html" class="nav-links">Ofertas</a></li>
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
        <li class="nav-list"><a href="#" class="nav-links">Adicionar produtos</a></li>
        <li class="nav-list"><a href="./meus_produtos.php" class="nav-links">Meus produtos</a></li>
        <li class="nav-list"><a href="./minha_loja.php" class="nav-links">Minha Loja</a></li>
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
        <section class="section-categoria">

        <?php
          // Verifique se o formulário foi enviado
          if ($_SERVER["REQUEST_METHOD"] == "GET") {
              // Verifique se a categoria foi selecionada
              if (isset($_GET["categoria"])) {
                  // Capture o valor da categoria selecionada
                  $categoria = $_GET["categoria"];
                  
                  // Consulta SQL com a categoria selecionada
                  $sql = "SELECT p.id, p.nome, p.preco, pi.imagem_path 
                          FROM produtos p 
                          LEFT JOIN produto_imagens pi ON p.id = pi.produto_id
                          WHERE p.categoria = ?";
                  
                  // Prepare a consulta
                  $stmt = $conn->prepare($sql);
                  $stmt->bind_param("s", $categoria);
                  
                  // Execute a consulta
                  $stmt->execute();
                  
                  // Obtenha o resultado da consulta
                  $result = $stmt->get_result();
              }
          }
        ?>

        <form method="GET" action="">
            <label id="label-categoria" for="input-categoria">Selecione uma categoria:</label>
            <select name="categoria" id="select-categoria" required>
                <option value="frutas" <?php if(isset($_GET["categoria"]) && $_GET["categoria"] == "frutas") echo "selected"; ?>>Frutas</option>
                <option value="verduras" <?php if(isset($_GET["categoria"]) && $_GET["categoria"] == "verduras") echo "selected"; ?>>Verduras</option>
                <option value="legumes" <?php if(isset($_GET["categoria"]) && $_GET["categoria"] == "legumes") echo "selected"; ?>>Legumes</option>
                <option value="vegetais" <?php if(isset($_GET["categoria"]) && $_GET["categoria"] == "vegetais") echo "selected"; ?>>Vegetais</option>
                <option value="graos" <?php if(isset($_GET["categoria"]) && $_GET["categoria"] == "graos") echo "selected"; ?>>Grãos</option>
            </select>
            <button type="submit" id="button-search-categoria">Buscar</button>
        </form>


    <div class="grid-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="grid-item">
                    <a href="item.php?id=<?= $row['id'] ?>">
                        <img class="img-produto" src="<?= htmlspecialchars($row['imagem_path']) ?>" alt="<?= htmlspecialchars($row['nome']) ?>">
                    </a>
                    <div class="product-info">
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
                        <h3 class="title-nome-produto"><?= htmlspecialchars($row['nome']) ?></h3>
                        <h1 class="title-preco">R$ <?= number_format($row['preco'], 2, ',', '.') ?></h1>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum produto encontrado.</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
    </div>

</section>

</body>
</html>

        </section>
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
      768: {
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
      // pagination: {
      //   el: ".swiper-pagination",
      //   clickable: true,
      //   centeredSlides: true,

      // },
      // navigation: {
      //   nextEl: ".swiper-button-next",
      //   prevEl: ".swiper-button-prev",
      // },
    });
</script>


</body>
</html>